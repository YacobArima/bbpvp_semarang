<?php

// Ensure temporary storage directories exist in /tmp for Vercel Serverless
$storagePaths = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

// Temporary diagnostic endpoint to find exact 500 error cause
if (isset($_GET['debug_check'])) {
    header('Content-Type: text/plain');
    echo "--- VERCEL RUNTIME DIAGNOSTIC ---\n";
    echo "PHP Version: " . PHP_VERSION . "\n";
    echo "pdo_pgsql loaded: " . (extension_loaded('pdo_pgsql') ? 'YES' : 'NO') . "\n";
    echo "APP_KEY: " . (getenv('APP_KEY') ? 'SET (' . substr(getenv('APP_KEY'), 0, 10) . '...)' : 'MISSING!') . "\n";
    echo "DB_CONNECTION: " . (getenv('DB_CONNECTION') ?: 'NOT SET') . "\n";
    echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . "\n";
    echo "DB_PORT: " . (getenv('DB_PORT') ?: 'NOT SET') . "\n";
    echo "DB_DATABASE: " . (getenv('DB_DATABASE') ?: 'NOT SET') . "\n";
    echo "DB_USERNAME: " . (getenv('DB_USERNAME') ?: 'NOT SET') . "\n";
    echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? 'SET' : 'MISSING!') . "\n";
    echo "Storage writable: " . (is_writable('/tmp/storage') ? 'YES' : 'NO') . "\n";

    if (getenv('DB_HOST')) {
        try {
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT') ?: '6543';
            $db = getenv('DB_DATABASE') ?: 'postgres';
            $user = getenv('DB_USERNAME');
            $pass = getenv('DB_PASSWORD');
            $sslmode = getenv('DB_SSLMODE') ?: 'require';
            $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode={$sslmode}";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_TIMEOUT => 4]);
            echo "Supabase DB Connection: SUCCESS\n";
        } catch (\Throwable $e) {
            echo "Supabase DB Connection: FAILED -> " . $e->getMessage() . "\n";
        }
    }

    exit;
}

// Forward request to Laravel public entrypoint
require __DIR__ . '/../public/index.php';
