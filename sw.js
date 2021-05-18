self.addEventListener('install', event => {
    const version = event.target.location.search;
    event.waitUntil(
        caches.open('static')
            .then(cache => {
                cache.addAll([
                    '/'
                ]);
            })
    );
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
});
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response){
                    return response;
                }
                return fetch(event.request);
            })
    );
});