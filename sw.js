self.addEventListener('install', event => {
    console.log('SW installed...');
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
    return self.clients.claim();
});
self.addEventListener('fetch', event => {
    console.log('fetch');
});