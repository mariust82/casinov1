self.addEventListener('install', event => {
    console.log('[SW] V1 installing…');
});

self.addEventListener('activate', event => {
    console.log('[SW] V1 now ready to handle fetches!');
});