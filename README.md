# Online Pos Platform

<a href="https://github.com/SaiHtetWaiYan/pos/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/SaiHtetWaiYan/pos">
</a>

🧶 A application build with Laravel , Sanctum , Vite.js , Vue.js , Pinia and Tailwindcss .

## Resources

- [Laravel](https://laravel.com)
- [Sanctum](https://laravel.com/docs/10.x/sanctum)
- [Vite](https://vitejs.dev/)
- [Vue](https://vuejs.org)
- [Pinia](https://pinia.vuejs.org)
- [Headlessui](https://headlessui.com)
- [Axios](https://axios-http.com)
- [Vue Router](https://router.vuejs.org)
- [Tailwindcss](https://tailwindcss.com)
- [Heroicons](https://heroicons.dev)

## Project setup

Clone the repo locally:

```sh
git clone https://github.com/SaiHtetWaiYan/pos.git
cd pos
```

Install PHP dependencies:

```sh
cd backend
composer install
```

Install NPM dependencies:

```sh
cd frontend
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Connect to local database

```sh
DB_DATABASE= database name
DB_USERNAME= database user name
DB_PASSWORD= database password
```

Run database migrations:

```sh
php artisan migrate
```

Run PHP development server:

```sh
php artisan serve
```

You're ready to go!
