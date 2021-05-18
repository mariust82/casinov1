self.addEventListener('install', event => {
    const version = event.target.location.search;
    event.waitUntil(
        caches.open('static')
            .then(cache => {
                cache.add('/');
                cache.add('/public/build/css/compilations/all.css' + version);
                cache.add('public/build/js/compilations/defer.js' + version);
            })
    );
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
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
                            return caches.open('dynamic')
                                .then(cache => {
                                    cache.put(event.request.url, dynamicResponse.clone());
                                    return dynamicResponse;
                                });
                        }).catch(error => console.log(error));
                }
            })
    );
});