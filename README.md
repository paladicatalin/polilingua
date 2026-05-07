# PoliLingua Website — Ghid de instalare

## Cerințe server
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache/Nginx cu mod_rewrite

## Pași de instalare

### 1. Încarcă fișierele pe server
Copiază tot conținutul folderului `polilingua/` în directorul public al serverului (ex: `/public_html/polilingua/`).

### 2. Creează baza de date
```sql
CREATE DATABASE polilingua CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Importă schema:
```bash
mysql -u your_user -p polilingua < database/schema.sql
```
Sau din phpMyAdmin: importă fișierul `database/schema.sql`.

### 3. Configurează conexiunea la baza de date
Editează fișierul `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'polilingua');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');
define('SITE_URL', 'https://yourdomain.com'); // fără slash la final
define('TRANSLATION_PROVIDER', 'mymemory'); // gratuit
define('MYMEMORY_API_BASE', 'https://api.mymemory.translated.net');
```

Dacă primești eroare de conexiune MySQL de tip `No such file or directory`, setează:
```php
define('DB_HOST', '127.0.0.1');
```

### 4. Setează permisiunile
```bash
chmod 755 uploads/cv/
chmod 644 config/config.php
```

### 5. Creează folderul pentru CV-uri
```bash
mkdir -p uploads/cv
chmod 755 uploads/cv
```

## Credențiale admin implicite
- URL: `https://yourdomain.com/admin/login.php`
- Email: `admin@polilingua.md`
- Parolă: `admin123`

⚠️ **IMPORTANT**: Schimbă parola după prima autentificare!

Pentru a schimba parola în phpMyAdmin, rulează:
```sql
UPDATE admins SET password_hash = '$2y$12$HASH_NOU' WHERE email = 'admin@polilingua.md';
```
Generează hash-ul în PHP:
```php
echo password_hash('parola_ta_noua', PASSWORD_BCRYPT);
```

## Structura proiectului
```
polilingua/
├── index.php              # Homepage public
├── cariere.php            # Pagina cariere
├── apply.php              # Handler formular aplicare
├── config/
│   ├── config.php         # Configurare DB și site
│   └── db.php             # Conexiune PDO
├── includes/
│   ├── functions.php      # Funcții helper
│   ├── auth.php           # Autentificare admin
│   ├── header.php         # Header public
│   └── footer.php         # Footer public
├── lang/
│   ├── ro.php             # Traduceri română
│   ├── ru.php             # Traduceri rusă
│   └── en.php             # Traduceri engleză
├── assets/
│   ├── css/style.css      # Stiluri principale
│   ├── css/responsive.css # Stiluri responsive
│   ├── js/main.js         # JavaScript principal
│   └── js/animations.js   # Animație orbită
├── uploads/cv/            # CV-uri încărcate
├── admin/
│   ├── login.php          # Login admin
│   ├── logout.php         # Logout admin
│   ├── dashboard.php      # Dashboard
│   ├── jobs.php           # Listă posturi
│   ├── job-create.php     # Adaugă post
│   ├── job-edit.php       # Editează post
│   ├── job-delete.php     # Șterge post
│   ├── applications.php   # Aplicații primite
│   ├── content.php        # Editare conținut site
│   ├── admin.css          # Stiluri admin panel
│   └── partials/          # Header/Footer/Sidebar admin
└── database/
    └── schema.sql         # Schema și date inițiale
```

## Utilizare Admin Panel

### Adăugare post vacant
1. Accesează `/admin/jobs.php`
2. Click pe „+ Adaugă post"
3. Completează câmpurile în română
4. Alege culoarea și rotația sticky note-ului
5. Salvează — RU/EN se traduc automat și postul apare pe site

### Gestionare servicii
- Accesează `/admin/services.php`
- Poți adăuga, edita, dezactiva sau șterge carduri de servicii
- Introduci titlul în română, iar RU/EN se traduc automat

### Gestionare aplicații
- Accesează `/admin/applications.php`
- Schimbă statusul aplicațiilor direct din tabel
- Descarcă CV-urile prin linkul „📎 CV"

### Editare conținut site
- Accesează `/admin/content.php`
- Editează doar coloana în română
- La salvare, textele sunt traduse automat în rusă și engleză
- Click „Salvează" — modificările apar imediat

### Traducere automată (RO -> RU/EN)
- Implicit este activ `mymemory` (gratuit):
  - `TRANSLATION_PROVIDER=mymemory`
  - `MYMEMORY_API_BASE=https://api.mymemory.translated.net`
  - `MYMEMORY_CONTACT_EMAIL` este opțional
- Opțional poți folosi `libretranslate`:
  - `TRANSLATION_PROVIDER=libretranslate`
  - `LIBRETRANSLATE_API_BASE=https://libretranslate.de`
  - `LIBRETRANSLATE_API_KEY` este opțional (în funcție de instanța folosită)
- Opțional poți folosi `openai`:
  - `TRANSLATION_PROVIDER=openai`
  - `OPENAI_API_KEY=...`
  - `OPENAI_TRANSLATION_MODEL` (implicit: `gpt-5-mini`)
  - `OPENAI_API_BASE` (implicit: `https://api.openai.com/v1`)
- Dacă providerul nu este disponibil, sistemul salvează în continuare româna și menține fallback pentru RU/EN

## Multi-limbă
Comutarea limbii se face din navbar: RO / RU / EN
- URL: `?lang=ro`, `?lang=ru`, `?lang=en`
- Sesiunea reține limba aleasă
- Fallback la română dacă traducerea lipsește

## Securitate
- Toate paginile admin sunt protejate cu sesiuni PHP
- Input sanitizat și prepared statements (PDO)
- Upload CV: validare extensie și mărime (max 5MB, PDF/DOC/DOCX)
- Fișierele CV sunt redenumite cu UUID aleatoriu

## Suport imagini
Imaginile sunt placeholder-e emoji/gradient. Pentru a adăuga imagini reale:
1. Uploadează imaginile în `/assets/images/`
2. Înlocuiește div-urile cu gradient cu tag-uri `<img src="...">`

---
Creat pentru PoliLingua © 2025
