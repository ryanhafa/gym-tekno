# AGENTS.md — Gym-Tekno

## Dev commands

| Action | Command |
|---|---|
| Full dev env (server + queue + logs + Vite) | `composer dev` |
| Dev server only | `php artisan serve` |
| Vite dev | `npm run dev` |
| Build assets | `npm run build` |
| Run all tests | `phpunit` or `./vendor/bin/phpunit` |
| Single test class | `phpunit tests/Feature/ExampleTest.php` |
| Lint | `./vendor/bin/pint` |
| Migrate | `php artisan migrate` |

## Architecture

- **Laravel 11** with PHP ^8.2, SQLite (`DB_CONNECTION=sqlite` in `.env`), Blade + Tailwind CSS 3 + Vite frontend.
- Session / Queue / Cache all use the `database` driver — must run `php artisan migrate` before those work in dev.
- No JS framework — vanilla JS via `resources/js/app.js` (axios only). JsBarcode CDN used for barcode rendering on member card page.
- PSR-4 autoload: `App\` → `app/`, `Database\Factories\` → `database/factories/`, `Database\Seeders\` → `database/seeders/`, `Tests\` → `tests/`.

## Features built

- **Homepage** (`/`): Gym landing page with hero, fasilitas, kelas, kontak sections.
- **Admin Member CRUD** (`/admin/members`): full management — name, email, phone, address, membership_type (basic/premium/platinum), status, quota, dates, notes. Includes search + filter + pagination.
- **Barcode check-in system**: Each member gets a unique barcode (`GTK` + 12 alphanumeric). Default quota = 30.
  - `/check-in` — public scan page (POST decrements quota, logs to `attendance_logs`).
  - `/admin/check-in` — scan page within admin panel (same functionality, admin layout).
  - `/check-in/lookup` / `/admin/check-in/lookup` — lookup member by barcode, view remaining quota + recent check-in history.
  - Member must be active and have quota > 0 to check in.
- **Member card** on detail page (`/admin/members/{id}`): renders barcode via JsBarcode, shows remaining quota, and lists check-in history.

## Testing

- PHPUnit 11, two suites: `tests/Unit` (plain PHPUnit), `tests/Feature` (Laravel app boot).
- `phpunit.xml` sets `APP_ENV=testing`, `CACHE_STORE=array`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=array`.
- DB tests: sqlite lines are **commented out** in `phpunit.xml` — uncomment `<env name="DB_CONNECTION" value="sqlite"/>` and `<env name="DB_DATABASE" value=":memory:"/>` to enable in-memory SQLite for feature tests.
- Feature tests use `Tests\TestCase` which extends `Illuminate\Foundation\Testing\TestCase`.

## Conventions

- **Code style**: Laravel Pint (PSR-2-based with Laravel defaults). Run `./vendor/bin/pint` before committing.
- **Migrations**: standard Laravel — `php artisan make:migration`.
- **No existing CI** or pre-commit hooks configured.
- **No existing instruction files** (CLAUDE.md, cursor rules, etc.) — this is the first.
