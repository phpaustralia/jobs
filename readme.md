# PHPMelb site
[![Build Status][ico-travis]][link-travis]

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

[link-travis]: https://travis-ci.org/phpaustralia/jobs
[ico-travis]: https://img.shields.io/travis/phpaustralia/jobs/master.svg?style=flat-square