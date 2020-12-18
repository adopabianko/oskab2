<p align="center">
  <a href="#"><img alt="oskab" src="https://user-images.githubusercontent.com/8348927/101473721-c2b06480-397c-11eb-9d08-b7b30d445049.png" width="400"/></a>
</p>

<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/made%20with-Laravel-red"></a>
<img src="https://img.shields.io/badge/version-1.0.0-blueviolet" alt="Version 1.0.0">
</p>

# Installation

Clone repository

```bash
$ git clone https://github.com/adopabianko/oskab.git
```

Copy file .env

```bash
$ cp -R .env.example .env
```

Run composer install

```bash
$ composer install
```

Run laravel sail

```bash
$ ./vendor/bin/sail up
```

Run database migration & seeder
```bash
$ ./vendor/bin/sail artisan migrate
```

```bash
$ ./vendor/bin/sail artisan db:seed
```

Access http://localhost:8282 via browser

Default user account :
 - Email : admin@oskab.com
 - Password : secret