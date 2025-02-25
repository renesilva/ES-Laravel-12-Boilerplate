# ES Laravel 12 Boilerplate

The package uses Laravel 12 as its base.
The system includes the following packages:

- [Keboola PHP CSV](https://github.com/keboola/php-csv) (For reading and exporting CSV files)
- [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) (For reading and exporting Excel files)
- [DOMPDF Wrapper for Laravel](https://github.com/barryvdh/laravel-dompdf) (For generating PDFs)
- [Laravel JSON API Debugger](https://packagist.org/packages/lanin/laravel-api-debugger) (For debugging JSON requests)
- [Laravel Meta](https://github.com/kodeine/laravel-meta) (For generating meta tables for models)
- [JWT Auth](https://github.com/PHP-Open-Source-Saver/jwt-auth) (For JWT authentication)
- [Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction) (For managing user permissions)
- [IDE Helper Generator for Laravel](https://github.com/barryvdh/laravel-ide-helper) (For model autocomplete in IDEs)

# Installation

## Run Composer

Run the following command to install the Composer dependencies.

```bash
composer install
```

## .env Configuration

Copy the `.env.example` file to `.env`.

```bash
cp .env.example .env
```

Once copied, generate the application key.

```bash
php artisan key:generate
```

Remember that every change to the .env file should be followed by a config:cache.

```bash
php artisan config:cache
```

## Database and Seeds

Create the database and configure the .env file with the database credentials.
Then run the migrations and seeds.

```
DB_DATABASE=DATABASE
DB_USERNAME=USER
DB_PASSWORD=PASSWORD
```

```bash
php artisan config:cache
```

Migrate the database and install the seeds.

```bash
php artisan migrate --seed
```

## JWT

To enable JWT, run the following command to generate the secret key.

```bash
php artisan jwt:secret
```

And verify that the following is generated in .env:

```
JWT_SECRET=XXXXXXXXXX
JWT_ALGO=HS256
```

```bash
php artisan config:cache
```

Remember that the auth.php configuration should use the JWT driver and the "api" guard.

```php
  'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
  ],
  'guards' => [
    'web' => [
      'driver' => 'session',
      'provider' => 'users',
    ],
    'api' => [
      'driver' => 'jwt',
      'provider' => 'users',
    ]
  ],
```

## Files

To link the public route http://XXXXXX/storage/ with the folder `/storage/app/public/`, run the following command:

```bash
php artisan storage:link
```

Run the following commands to create the folders where uploaded files will be stored:

```bash
mkdir -p storage/app/public/business/images
mkdir storage/app/reports
```

To run the CSV example, run the following commands:

```bash
mkdir storage/app/examples
cp resources/examples/* storage/app/examples
```

## Sample User System (Optional)

The system uses the [Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction) package to manage
user roles and permissions.

We create the roles:

- superadmin. The Super Admin will manage users.
- admin. Leave blank to allow adding features.

Using the following command, create the permissions and assign them to the roles. We are using the _api_ guard for
permissions.

```bash
php artisan app:user-examples-init
```

## Tests

Copy the `.env` file to `.env.testing`.

```bash
cp .env .env.testing
```

And in `.env.testing` configure the test database:

```
DB_CONNECTION=sqlite
DB_DATABASE=':memory:'
```

And remove all the configuration cache:

```bash
php artisan config:clear
```

To run the tests, execute the following command:

```bash
php artisan test
```

## Running the Project

To run the project, execute the following command:

```bash
php artisan serve
```

## IDE Helper

IDE Helper assists with model autocomplete.
To generate it, run these commands:

```bash
php artisan ide-helper:generate
```

```bash
php artisan ide-helper:models --write
```

# Documentation

- [Laravel 12](https://laravel.com/docs/10.x/releases)
- [Implementing JWT Auth with Laravel](https://blog.logrocket.com/implementing-jwt-authentication-laravel-9/)
