<?php

// 1. Paksa Laravel menulis cache ke folder /tmp (satu-satunya folder writable di Vercel)
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');

// 2. Jika kamu pakai Session atau Cache, arahkan ke array/cookie agar tidak nulis file
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_DRIVER=array');

// 3. Panggil file index asli
require __DIR__ . '/../public/index.php';