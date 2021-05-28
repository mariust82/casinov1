let CONFIGURATIONS = {
    cache_version: 2,
    resources: [
        "/manifest.json",
        // CSS
        "/public/build/css/compilations/all.css",
        "/public/build/css/compilations/gameplay.css",
        "/public/build/css/compilations/casino_view.css",
        "/public/build/css/compilations/defer.css",
        "/public/build/css/compilations/ion.rangeSlider.css",
        // JS
        "/public/build/js/compilations/blog.js",
        "/public/build/js/compilations/casino_view.js",
        "/public/build/js/compilations/contact.js",
        "/public/build/js/compilations/defer.js",
        "/public/build/js/compilations/gameplay.js",
        "/public/build/js/compilations/main.js",
        // Fonts
        "/public/build/fonts/OpenSans-Regular-latin.woff2",
        "/public/build/fonts/OpenSansCondensed-Bold-latin.woff2",
        "/public/build/fonts/icomoon.ttf?stten7"
    ],
    images: [
        "/public/favicon.ico",
        "/public/build/images/text-header/home-img-2.webp",
        "/public/build/images/default_casino_logo.png"
    ],
    pages: [
        "/",
        "/bonus-list/no-deposit-bonus",
        "/casinos/new",
        "/offline"
    ],
    getStaticResources: function () {
        return [
            ...this.resources,
            ...this.images,
            ...this.pages
        ];
    },
    isNetworkOnly: function (url) {
        if (url.match(/(google)|(tracker)/)) {
            return true;
        }
        return false;
    },
    isPreCached: function (url) {
        return this.inResources(url);
    },
    inResources: function (url) {
        for (let i = 0; i < this.resources.length; i++) {
            if (url.indexOf(this.resources[i]) !== -1) {
                return true;
            }
        }
        return false;
    },
    _cache_static: "static-v",
    get cache_static() {
        return this._cache_static + this.cache_version;
    },
    _cache_dynamic: "dynamic-v",
    get cache_dynamic() {
        return this._cache_dynamic + this.cache_version;
    }
};

/**
 * Pre-cache application shell content.
 *
 * @param appVersion
 *
 * @returns {Promise<Cache | void>}
 */
function preCacheAppShell(appVersion) {
    return caches.open(CONFIGURATIONS.cache_static)
        .then((cache) => {
            let resources = CONFIGURATIONS.getStaticResources();
            resources.forEach((url) => {
                url = url.match(/\.(css|js)$/) ? url + appVersion : url;
                cache.add(url)
                    .catch((error) => console.log('[SW] Something went wrong with adding url "' + url + '". Log: ' + error));
            });
        })
        .catch((error) => console.log('[SW] Something went wrong with caching AppShell: ' + error));
}

self.addEventListener('install', (event) => {
    event.waitUntil(preCacheAppShell(event.target.location.search));
});

self.addEventListener('activate', (event) => {
    console.log('[SW] V1 now ready to handle fetches!');
    event.waitUntil(
        caches.keys()
            .then((keyList) => {
                return Promise.all(keyList.map(key => {
                    if (key !== CONFIGURATIONS.cache_static && key !== CONFIGURATIONS.cache_dynamic) {
                        return caches.delete(key)
                            .catch((error) => console.log('[SW] Something went wrong when deleting key: ' + error));
                    }
                }));
            })
            .catch((error) => console.log('[SW] Something went wrong when deleting caches: ' + error))
    );

    return self.clients.claim();
});

self.addEventListener('fetch', (event) => {
    if (!CONFIGURATIONS.isNetworkOnly(event.request.url) && event.request.method === 'GET') {
        event.respondWith(
            caches.match(event.request)
                .then((response) => {
                    return response || fetch(event.request)
                        .then((dynamicResponse) => {
                            return !dynamicResponse.ok ? dynamicResponse : caches.open(CONFIGURATIONS.cache_dynamic)
                                .then((cache) => {
                                    cache.put(event.request, dynamicResponse.clone());
                                    return dynamicResponse;
                                })
                                .catch(error => console.log('[SW] Something went wrong with storing dynamic cache: ' + error));
                        })
                        .catch((error) => {
                            return caches.open(CONFIGURATIONS.cache_static)
                                .then((cache) => {
                                    if (event.request.headers.get('accept').includes('text/html')) {
                                        return cache.match('offline');
                                    }
                                });
                        });
                })
                .catch((error) => console.log('[SW] Something went wrong with matching dynamic cache: ' + error))
        );
    }
    return;
});
self.addEventListener('notificationclick', function (event) {
    var notification = event.notification;
    var action = event.action;

    console.log(notification);

    if (action === 'confirm') {
        console.log('Confirm was chosen');
        notification.close();
    } else {
        console.log(action);
        event.waitUntil(
            clients.matchAll()
                .then(function (clis) {
                    var client = clis.find(function (c) {
                        return c.visibilityState === 'visible';
                    });

                    if (client !== undefined) {
                        client.navigate(notification.data.url);
                        client.focus();
                    } else {
                        clients.openWindow(notification.data.url);
                    }
                    notification.close();
                })
        );
    }
});

self.addEventListener('notificationclose', function (event) {
    console.log('Notification was closed', event);
});

self.addEventListener('push', function (event) {
    console.log('Push Notification received', event);

    var data = {title: 'New!', content: 'Something new happened!', openUrl: '/'};
    if (event.data) {
        data = JSON.parse(event.data.text());
    }
    var options = {
        body: data.content,
        icon: '/src/images/icons/app-icon-96x96.png',
        badge: '/src/images/icons/app-icon-96x96.png',
        data: {
            url: data.openUrl
        },
        image: '/public/build/images/icons/icon-256x256.png',
        dir: 'ltr',
        lang: 'en-US', // BCP 47,
        vibrate: [100, 50, 200],
        tag: 'confirm-notification',
        renotify: true,
        actions: [
            {action: 'confirm', title: 'Okay', icon: '/public/build/images/icons/icon-96x96.png'},
            {action: 'cancel', title: 'Cancel', icon: '/public/build/images/icons/icon-96x96.png'}
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});