const CACHE_VERSION = 1;
const CACHE_STATIC = 'static-v' + CACHE_VERSION;
const CACHE_DYNAMIC = 'dynamic-v' + CACHE_VERSION;

self.addEventListener('install', event => {
    const APP_VERSION = event.target.location.search;
    event.waitUntil(
        caches.open(CACHE_STATIC)
            .then(cache => {
                cache.add('/');
                cache.add('/bonus-list/no-deposit-bonus');
                cache.add('/casinos/new');
                cache.add('/public/build/css/compilations/all.css' + APP_VERSION);
                cache.add('/public/build/css/compilations/gameplay.css' + APP_VERSION);
                cache.add('/public/build/css/compilations/casino_view.css' + APP_VERSION);
                cache.add('/public/build/css/compilations/defer.css' + APP_VERSION);
                cache.add('/public/build/css/compilations/ion.rangeSlider' + APP_VERSION);

                cache.add('/public/build/js/parts/global_js/jquery-2.1.3.min.js' + APP_VERSION);
                cache.add('/public/build/js/parts/assets/jquery-nicescroll.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/main.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/vote.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/gameplay.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/casino_review.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/contact.js' + APP_VERSION);
                cache.add('/public/build/js/compilations/defer.js' + APP_VERSION);
            })
    );
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
    event.waitUntil(
        caches.keys()
            .then(keyList => {
                return Promise.all(keyList.map(key => {
                    if (key !== CACHE_STATIC && key !== CACHE_DYNAMIC) {
                        return caches.delete(key);
                    }
                }));
            })
    );

    return self.clients.claim();
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                } else {
                    return fetch(event.request)
                        .then(dynamicResponse => {
                            return caches.open(CACHE_DYNAMIC)
                                .then(cache => {
                                    if (!event.request.url.match(/(google)|(tracker)/)) {
                                        cache.put(event.request.url, dynamicResponse.clone());
                                    }
                                    return dynamicResponse;
                                });
                        }).catch(function (error) {

                        });
                }
            })
    );
});