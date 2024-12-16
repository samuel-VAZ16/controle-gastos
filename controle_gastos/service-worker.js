const CACHE_NAME = 'controle-gastos-cache-v1';
const urlsToCache = [
  '/',
  '/index.php',
  '/cadastrar.php',
  '/conexao.php',
  '/manifest.json',
  '/icons/icon-192x192.png',
  '/icons/icon-512x512.png',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
  // Adicione mais URLs que você deseja que sejam armazenadas em cache
];

self.addEventListener('install', (event) => {
  // Instalação do Service Worker e cache de arquivos
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Files cached');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', (event) => {
  // Intercepta as requisições e serve os arquivos do cache quando offline
  event.respondWith(
    caches.match(event.request)
      .then((cachedResponse) => {
        return cachedResponse || fetch(event.request);
      })
  );
});

self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];

  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (!cacheWhitelist.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});