let CONFIGURATIONS = {
    cache_version: 1,
    resources: [
        "/manifest.json",
        // CSS
        "/public/build/css/compilations/all.css",
        "/public/build/css/compilations/gameplay.css",
        "/public/build/css/compilations/casino_view.css",
        "/public/build/css/compilations/defer.css",
        // JS
        "/public/build/js/compilations/main.js",
        "/public/build/js/compilations/blog.js",
        "/public/build/js/compilations/casino_view.js",
        "/public/build/js/compilations/contact.js",
        "/public/build/js/compilations/gameplay.js",
        "/public/build/js/compilations/defer.js",
        // Fonts
        "/public/build/fonts/OpenSans-Regular-latin.woff2",
        "/public/build/fonts/OpenSansCondensed-Bold-latin.woff2",
        "/public/build/fonts/icomoon.ttf?stten7"
    ],
    images: [
        "/public/favicon.ico",
        "/public/build/images/text-header/home-img-2.webp",
        "/public/build/images/games/default_game_ss.png",
        "/public/build/images/default_casino_logo.png"
    ],
    offline_page: "/offline",
    pages: [
        "/pwa-popups?device=android",
        "/pwa-popups?device=ios"
    ],
    getStaticResources: function () {
        return [
            ...this.resources,
            ...this.images,
            ...this.pages,
            this.offline_page
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
    getOfflinePage: function (accept) {
        return caches.open(this.cache_static)
            .then((cache) => accept.includes('text/html') ? cache.match(this.offline_page) : new Response());
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
    CONFIGURATIONS.cache_version = appVersion.split('=')[1];
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
    if (event.request.method === 'GET' && !CONFIGURATIONS.isNetworkOnly(event.request.url)) {
        if (CONFIGURATIONS.isPreCached(event.request.url)) {
            console.log('Get from pre-cached: ', event.request.url);
            event.respondWith(
                caches.match(event.request).catch((error) => console.log('Failed from pre-cached: ', error))
            )
        } else {
            event.respondWith(
                fetch(event.request)
                    .then((res) => {
                        console.log('res.status: ', res.status);
                        if (res.status === 200) {
                            let clonedResponse = res.clone();
                            console.log('Content-Length: ', clonedResponse.headers.get('Content-Length'));
                            caches.open(CONFIGURATIONS.cache_dynamic)
                                .then(function (cache) {
                                    cache.put(event.request.url, clonedResponse)
                                        .catch(error => console.log("Something went wrong with storage", error));
                                });
                        }
                        return res;
                    })
                    .catch((error) => {
                        console.log('Fetch error: ', error);
                        return caches.match(event.request)
                            .then((response) => {
                                return response || CONFIGURATIONS.getOfflinePage(event.request.headers.get('accept'));
                            }).catch(() => CONFIGURATIONS.getOfflinePage(event.request.headers.get('accept')));
                    })
            );
        }
    }
    return;
});
self.addEventListener('notificationclick', function (event) {
    var notification = event.notification;
    var action = event.action;

    if (action === 'open') {
        event.waitUntil(
            clients.matchAll()
                .then(function (clis) {
                    let client = clis.find(function (c) {
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
    } else {
        notification.close();
    }
});

self.addEventListener('push', function (event) {
    let data = {title: 'New bonuses!', content: 'We have new bonuses please have a look!', openUrl: '/'};
    if (event.data) {
        data = JSON.parse(event.data.text());
    }
    let options = {
        body: data.content,
        icon: '/src/images/icons/maskable_icon_x96.png',
        badge: '/src/images/icons/maskable_icon_x48.png',
        data: {
            url: data.openUrl
        },
        dir: 'ltr',
        lang: 'en-US',
        vibrate: [100, 50, 200],
        tag: 'confirm-notification',
        renotify: true,
        actions: [
            {action: 'open', title: 'Open'}
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});