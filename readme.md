# Press Start Platform
Cloud service for interacting with [Press Start CMS](https://github.com/reenekt/press-start-cms)

## Table of contents
* [Features](#Features)
* [Installation](#Installation)

## Features
For users:  
* Monitoring state of your CMS applications
* Installing plugins in your applications through the platform
* Updating and deleting plugins in your applications

For developers
* Uploading plugins

## Installation
### 1. Clone repository
```
git clone https://github.com/reenekt/press-start-platform.git
```

### 2. Env
Copy `<project dir>/.env.example` to `<project dir>/.env` and customize for yourself

### 3. Composer
Install composer dependencies
```
composer install
```

### 4. NPM/Yarn
Install frontend dependencies with NPM or Yarn
```
npm install
```
or
```
yarn
```

### 5. Create Database
Create new MySQL database and update your `.env` settings

### 6. Artisan
Generate application key
```
php artisan key:generate
```

Apply migrations
```
php artisan migrate
```


<p align="center">Created with using <a href="https://laravel.com">Laravel Framework</a></p><br>
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>
