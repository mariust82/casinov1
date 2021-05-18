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
    console.log('fetch');
});