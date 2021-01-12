<p align="center">
  <a href="#"><img alt="oskab" src="https://user-images.githubusercontent.com/8348927/104297441-73b69b80-54f5-11eb-9224-5ea09e33db2e.png" width="350"/></a>
</p>

<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/made%20with-Laravel-red"></a>
<img src="https://img.shields.io/badge/version-1.0.0-blueviolet" alt="Version 1.0.0">
</p>

# Installation

#### Step 1 Checkout Oskab

```bash
$ git clone https://github.com/adopabianko/oskab.git
```

#### Step 2 Copy file .env

```bash
$ cp -R .env.example .env
```

#### Step 3 Run composer install

```bash
$ composer install
```

#### Step 4 Run laravel sail

```bash
$ ./vendor/bin/sail up
```

#### Step 5 Run database migration & seeder
```bash
$ ./vendor/bin/sail artisan migrate
```

```bash
$ ./vendor/bin/sail artisan db:seed
```

#### Step 6 Access http://localhost:8282 via browser

Default user account :
 - Email : admin@oskab.com
 - Password : secret
