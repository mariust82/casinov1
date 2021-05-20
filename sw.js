let CONFIGURATIONS = {
    cache_version: 2,
    resources: [
        "/",
        "/bonus-list/no-deposit-bonus",
        "/casinos/new",
        "/public/build/css/compilations/all.css",
        "/public/build/css/compilations/gameplay.css",
        "/public/build/css/compilations/casino_view.css",
        "/public/build/css/compilations/defer.css",
        "/public/build/css/compilations/ion.rangeSlider.css",
        "/public/build/js/parts/global_js/jquery-2.1.3.min.js",
        "/public/build/js/parts/assets/jquery-nicescroll.js",
        "/public/build/js/compilations/main.js",
        "/public/build/js/compilations/vote.js",
        "/public/build/js/compilations/gameplay.js",
        "/public/build/js/compilations/casino_review.js",
        "/public/build/js/compilations/contact.js",
        "/public/build/js/compilations/defer.js"
    ],
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
            CONFIGURATIONS.resources.forEach((url) => {
                cache.add(url)
                    .catch((error) => console.log('[SW] Something went wrong with adding url "' + url + '". Log: ' + error));
            });
            return true;
        })
        .catch((error) => console.log('[SW] Something went wrong with caching AppShell: ' + error));
}

self.addEventListener('install', event => {
    event.waitUntil(preCacheAppShell(event.target.location.search));
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
    event.waitUntil(
        caches.keys()
            .then((keyList) => {
                return Promise.all(keyList.map(key => {
                    if (key !== CONFIGURATIONS.cache_static && key !== CONFIGURATIONS.cache_dynamic) {
                        return caches.delete(key);
                    }
                }));
            })
            .catch((error) => console.log('[SW] Something went wrong when deleting caches: ' + error))
    );

    return self.clients.claim();
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                return response || fetch(event.request)
                    .then((dynamicResponse) => {
                        return caches.open(CONFIGURATIONS.cache_dynamic)
                            .then((cache) => {
                                if (!event.request.url.match(/(google)|(tracker)|(png)/)) {
                                    cache.put(event.request.url, dynamicResponse.clone());
                                }
                                return dynamicResponse;
                            })
                            .catch((error) => console.log('[SW] Something went wrong with dynamic cache: ' + error));
                    })
                    .catch((error) => console.log('[SW] Something went wrong with fetch: ' + error));
            })
            .catch((error) => console.log('[SW] Something went wrong with cache: ' + error))
    );
});