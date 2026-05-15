<?php
// PoliLingua - Database Configuration
// Edit these values to match your hosting environment.

define('APP_ENV', 'production');
define('APP_DEBUG', false);

ini_set('display_errors', APP_DEBUG ? '1' : '0');
ini_set('display_startup_errors', APP_DEBUG ? '1' : '0');
error_reporting(E_ALL);

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', '1');
}
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', 'Lax');

define('DB_HOST', 'sql305.infinityfree.com');
define('DB_PORT', 3306);
define('DB_NAME', 'polilingua');
define('DB_USER', 'if0_41930275');
define('DB_PASS', 'gVobGPBq1klnIAh');
define('DB_CHARSET', 'utf8mb4');

define('SITE_URL', 'https://poli-lingua.infinityfree.me');
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
