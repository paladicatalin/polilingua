<?php
// PoliLingua - Database Configuration
// Edit these values to match your hosting environment

define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'polilingua');
define('DB_USER', 'root');        // Change to your DB username
define('DB_PASS', '');            // Change to your DB password
define('DB_CHARSET', 'utf8mb4');

define('SITE_URL', 'http://localhost/polilingua'); // Change to your domain
define('UPLOAD_DIR', __DIR__ . '/../uploads/cv/');
define('UPLOAD_URL', SITE_URL . '/uploads/cv/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx']);

define('SESSION_NAME', 'polilingua_admin');
define('ADMIN_TITLE', 'PoliLingua Admin');

// Default language
define('DEFAULT_LANG', 'ro');
define('SUPPORTED_LANGS', ['ro', 'ru', 'en']);

// Auto translation provider (RO -> RU/EN)
// Available: 'mymemory' (free, default), 'libretranslate', 'openai'
define('TRANSLATION_PROVIDER', 'mymemory');

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
