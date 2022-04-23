<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1 align="center">
Art gallery
</h1>

<h4 align="center">
<a href="https://laravel.com/docs/9.x/sail">Laravel Sail</a> + <a href="https://vitejs.dev/">Vite</a> + <a href="https://tailwindcss.com/">Tailwind</a>
</h4>

# Requirements

To run this project in your local machine you will need to install [Docker Desktop](https://www.docker.com/products/docker-desktop) and [Docker Compose](https://docs.docker.com/compose/install/).

## How to install the project

```zsh
$ git clone https://github.com/Kidoncio/art-gallery
$ cd art-gallery
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
$ cp .env.example .env
$ ./vendor/bin/sail up -d
$ ./vendor/bin/sail php artisan key:generate
$ ./vendor/bin/sail npm install
```

## How to run

```zsh
$ ./vendor/bin/sail php artisan serve
$ ./vendor/bin/sail npm run dev
```

After that your server will be running at `http://localhost/`
