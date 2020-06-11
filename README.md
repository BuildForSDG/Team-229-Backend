<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

EduForm Backend
==================

The application backend is built using [Laravel 6.2](https://laravel.com/docs/6.x/installation) supported by [MongoDB](https://docs.mongodb.com/manual/tutorial/getting-started/) a NoSQL database which provides us with flexibility and scalability since the data to be stored largely varries in structure. Laravel-mongodb connection requires a package called [jenssegers](https://github.com/jenssegers/laravel-mongodb) that adds functionalities to the Eloquent model and Query builder for MongoDB, using the original Laravel API. This library extends the original Laravel classes, so it uses exactly the same methods.

Installation
------------

To run this project you must have php 7.2 or higher installed on your machine.
After you have cloned this repository run composer update or composer install to list all the packages of the currently installed versions and attemps to build a set of package that work together.
Before you proceed make sure to generate your json web token [jwt-token](https://jwt-auth.readthedocs.io/en/docs/laravel-installation/) secret key using the helper command:

```bash
$php artisan jwt:secret
```

This will update your .env file with something like JWT_SECRET=foobar
