# PHP Australia Jobs Board
[![Build Status][ico-travis]][link-travis]

## About

We're moving the phpMelb mailing list (which is currently just used for job postings) to a web app. The new product will duplicate functionality and include the features of a mailing list people most liked:

* delivery to inbox
* email replies go to everyone
* hide recipient email addresses (replies go to the application)

phpMelb members really liked hearing feedback from seniors in the industry about what was reasonable with regards to expected skills, remuneration, etc.

The road map includes web-based views (for search engine indexing and lowered barrier to entry for those wanting to see what's being posted) which will provide a better UX that the mailman archives (look more like a blog post with nested comments on one page, rather than one email per web page and clunky navigation).

Eventually, we want to assign posts to sectors, which people can selectively subscribe to. To start with, this will be regions.

As well as allowing me to then remove the only remaining mailman list from my server, this will also be a group project. Anyone can collaborate here, and via code. This will help new developers get used to git processes, allow mentors to provide code reviews, and more.

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
npm install
gulp
```

## Serve

```bash
php artisan serve
```

## Login as admin

- email: admin@phpmelb.com
- password: secret

## Create dummy data:

```bash
php artisan tinker
> $user = factory(App\User::class)->create();
> factory(App\Job::class, 50)->create(['user_id' => $user->id, 'approved' => 1]);
```

[link-travis]: https://travis-ci.org/phpaustralia/jobs
[ico-travis]: https://img.shields.io/travis/phpaustralia/jobs/master.svg?style=flat-square
