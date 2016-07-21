# PHPMelb site

## Install

```bash
git clone https://github.com/phpaustralia/jobs.git
cd jobs
cp .env.example .env
```

add your database details to .env, then:

```bash
composer install
php artisan migrate
php artisan db:seed
```

## Serve

```bash
php artisan serve
```

## Login as admin

- email: admin@phpmelb.com
- password: secret
