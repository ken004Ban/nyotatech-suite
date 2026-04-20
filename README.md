# Mystery Shopping Report Generator

A lightweight Laravel (Blade) app for field officers to capture inspection data and generate a structured PDF report.

## Tech

- Laravel (Blade)
- SQLite
- Bootstrap 5 (CDN)
- PDF: `barryvdh/laravel-dompdf`

No React/Vue, no Docker, no Redis, no queues.

---

## SECTION 1 — DEVICE SETUP

### Detect OS

- Windows: `ver`
- Ubuntu: `cat /etc/os-release`
- macOS: `sw_vers`

### Install prerequisites

#### Windows (recommended approach)

1. Install PHP 8.2+ and enable extensions:
   - `openssl`, `curl`, `mbstring`, `fileinfo`, `zip`, `pdo_sqlite`, `sqlite3`
2. Install Composer
3. Install Git
4. Install Node.js LTS (for Laravel’s Vite tooling; optional if you keep assets on CDN only)
5. Install SQLite (optional; PHP uses SQLite via extensions)

Verify:

```powershell
php -v
composer -V
git --version
node -v
php -m | Select-String -Pattern "pdo_sqlite|sqlite3|openssl"
```

#### Ubuntu

```bash
sudo apt update
sudo apt install -y \
  php8.2 php8.2-cli php8.2-sqlite3 php8.2-xml php8.2-mbstring php8.2-curl \
  unzip git sqlite3 nodejs npm

# Composer (official installer)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php

php -v && composer -V && node -v
```

#### macOS (Homebrew)

```bash
brew install php@8.2 composer git node sqlite3
php -v && composer -V && node -v
```

---

## SECTION 2 — CREATE PROJECT

```bash
composer create-project laravel/laravel mystery-report
cd mystery-report
php artisan serve
```

---

## SECTION 3 — DATABASE CONFIGURATION (SQLite)

1. Create the SQLite database file:
   - `database/database.sqlite`
2. Configure `.env`:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

---

## SECTION 4 — DATABASE SCHEMA

Table: `reports`

- `id`
- `branch` (string)
- `date_time` (datetime)
- `evaluator` (string)
- `staff_name` (string)
- `shop_health` (text)
- `service_rating` (integer, 1–5)
- `staff_competence` (string: `Low` / `Medium` / `High`)
- `pricing_notes` (text, nullable)
- `recommendations` (text, nullable)
- `created_at`, `updated_at`

---

## SECTION 5 — RUN MIGRATION

```bash
php artisan migrate
```

---

## SECTION 6 — CONTROLLER

Controller: [`app/Http/Controllers/ReportController.php`](app/Http/Controllers/ReportController.php)

Methods:

- `index()`
- `create()`
- `store()`
- `show()`
- `downloadPdf()`

Validation (key required fields):

- `branch` required
- `date_time` required
- `staff_name` required
- `service_rating` required

---

## SECTION 7 — ROUTES

Defined in [`routes/web.php`](routes/web.php):

- `GET /`
- `GET /reports`
- `GET /reports/create`
- `POST /reports`
- `GET /reports/{id}`
- `GET /reports/{id}/pdf`

---

## SECTION 8–13 — USER INTERFACE + DESIGN

Bootstrap 5 Blade views:

- Layout: [`resources/views/layout.blade.php`](resources/views/layout.blade.php)
- Create form: [`resources/views/reports/create.blade.php`](resources/views/reports/create.blade.php)
- List: [`resources/views/reports/index.blade.php`](resources/views/reports/index.blade.php)
- View: [`resources/views/reports/show.blade.php`](resources/views/reports/show.blade.php)

Design goals:

- Clean cards
- Mobile responsive
- Fast (CDN Bootstrap)

---

## SECTION 12 — PDF GENERATION

Install:

```bash
composer require barryvdh/laravel-dompdf
```

PDF template:

- [`resources/views/reports/pdf.blade.php`](resources/views/reports/pdf.blade.php)

Download route:

- `GET /reports/{id}/pdf`

---

## SECTION 14 — OPTIONAL FEATURES INCLUDED

- Flash success message after creating a report.
- Form repopulates with `old()` values on validation failure.
- Default `date_time` prefilled to current date/time.

---

## SECTION 15 — PROJECT STRUCTURE

Key paths:

```text
app/
  Http/Controllers/ReportController.php
  Models/Report.php
routes/
  web.php
resources/
  views/layout.blade.php
  views/reports/create.blade.php
  views/reports/index.blade.php
  views/reports/show.blade.php
  views/reports/pdf.blade.php
database/
  database.sqlite
  migrations/*create_reports_table.php
public/
```

---

## SECTION 16 — TESTING CHECKLIST (manual)

- [ ] Visit `/` → reports list loads.
- [ ] Visit `/reports/create` → form loads.
- [ ] Submit empty form → validation errors show.
- [ ] Submit valid report → success message + redirected to report view.
- [ ] Visit `/reports` → report appears in list.
- [ ] Open report → sections render correctly.
- [ ] Download PDF → file downloads and content matches.

---

## SECTION 17 — LOCAL DEPLOYMENT

```bash
php artisan serve
```

Open:

- http://127.0.0.1:8000

---

## SECTION 18 — PRODUCTION DEPLOYMENT

### Shared hosting (Apache)

1. Upload the project (excluding `node_modules`).
2. Set the **document root** to the `public/` directory.
3. Ensure write permissions:
   - `storage/`
   - `bootstrap/cache/`
4. Create `.env` (production):
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_KEY=` (generate if needed)
   - `DB_CONNECTION=sqlite`
   - `DB_DATABASE=database/database.sqlite`
5. Run (via SSH / terminal, if available):

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### VPS (Apache or Nginx)

- Same Laravel deployment steps as above.
- Ensure `pdo_sqlite` is enabled in PHP.
- Keep `database/database.sqlite` outside web root (default Laravel layout already does).

---

## SECTION 19 — BACKUP STRATEGY

Minimum viable backups:

- **Database**: copy `database/database.sqlite` on a schedule (daily/weekly). Keep at least 7–30 days.
- **Before upgrades/migrations**: take a snapshot copy of the SQLite file.
- **Off-site**: store an encrypted copy outside the server.

If you later add uploads:

- Also back up `storage/app/`.

---

## SECTION 20 — FUTURE SCALING

- Add authentication (Laravel Breeze) and restrict reports per user/branch.
- Add dashboard analytics (average rating per branch, trends).
- Add filtering/export (CSV).
- If write concurrency grows, migrate from SQLite to MySQL/PostgreSQL.
- Improve mobile UX (PWA) and offline capture if needed.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
