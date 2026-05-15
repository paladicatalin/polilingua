<?php
// PoliLingua - Database Configuration
// Edit these values to match your hosting environment or set environment variables.

// Load .env file if it exists
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0 || strpos($line, '=') === false) {
            continue; // Skip comments and invalid lines
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!getenv($key)) {
            putenv("$key=$value");
        }
    }
}

define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', getenv('APP_DEBUG') === '1');

ini_set('display_errors', APP_DEBUG ? '1' : '0');
ini_set('display_startup_errors', APP_DEBUG ? '1' : '0');
error_reporting(E_ALL);

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', '1');
}
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', 'Lax');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: 3306);
define('DB_NAME', getenv('DB_NAME') ?: 'polilingua');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

$configuredSiteUrl = getenv('SITE_URL');
if (is_string($configuredSiteUrl) && trim($configuredSiteUrl) !== '') {
    define('SITE_URL', rtrim(trim($configuredSiteUrl), '/'));
} elseif (!empty($_SERVER['HTTP_HOST'])) {
    $scheme = 'http';
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $scheme = 'https';
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $scheme = strtolower(explode(',', $_SERVER['HTTP_X_FORWARDED_PROTO'])[0]);
    } elseif (!empty($_SERVER['REQUEST_SCHEME'])) {
        $scheme = strtolower((string)$_SERVER['REQUEST_SCHEME']);
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on') {
        $scheme = 'https';
    } elseif (!empty($_SERVER['HTTP_X_URL_SCHEME'])) {
        $scheme = strtolower((string)$_SERVER['HTTP_X_URL_SCHEME']);
    }
    if ($scheme !== 'https' && $scheme !== 'http') {
        $scheme = 'http';
    }

    $scriptPath = $_SERVER['SCRIPT_NAME'] ?? '';
    $rootPath = rtrim(dirname($scriptPath), '/\\');
    if ($rootPath !== '' && $rootPath !== '.') {
        if (str_contains($rootPath, '/admin')) {
            $rootPath = rtrim(dirname($rootPath), '/\\');
        }
        if ($rootPath === '/' || $rootPath === '.') {
            $rootPath = '';
        }
    } else {
        $rootPath = '';
    }
    define('SITE_URL', $scheme . '://' . $_SERVER['HTTP_HOST'] . $rootPath);
} else {
    define('SITE_URL', 'http://localhost/polilingua');
}
define('UPLOAD_DIR', __DIR__ . '/../uploads/cv/');
define('UPLOAD_URL', rtrim(SITE_URL, '/') . '/uploads/cv/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx']);

define('SESSION_NAME', 'polilingua_admin');
define('ADMIN_TITLE', 'PoliLingua Admin');

// Default language
define('DEFAULT_LANG', 'ro');
define('SUPPORTED_LANGS', ['ro', 'ru', 'en']);

// Auto translation provider (RO -> RU/EN)
// Available: 'mymemory' (free, default), 'libretranslate', 'openai'
define('TRANSLATION_PROVIDER', getenv('TRANSLATION_PROVIDER') ?: 'mymemory');

// Free provider (MyMemory)
define('MYMEMORY_API_BASE', getenv('MYMEMORY_API_BASE') ?: 'https://api.mymemory.translated.net');
define('MYMEMORY_CONTACT_EMAIL', getenv('MYMEMORY_CONTACT_EMAIL') ?: '');

// Free provider (public instance; can be replaced with your own LibreTranslate server)
define('LIBRETRANSLATE_API_BASE', getenv('LIBRETRANSLATE_API_BASE') ?: 'https://libretranslate.de');
define('LIBRETRANSLATE_API_KEY', getenv('LIBRETRANSLATE_API_KEY') ?: '');

// Optional paid provider
define('OPENAI_API_KEY', getenv('OPENAI_API_KEY') ?: '');
define('OPENAI_API_BASE', getenv('OPENAI_API_BASE') ?: 'https://api.openai.com/v1');
define('OPENAI_TRANSLATION_MODEL', getenv('OPENAI_TRANSLATION_MODEL') ?: 'gpt-5-mini');
