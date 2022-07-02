1. Install composer packages

```
$ composer install
```

2. Install npm packages

```
$ npm i
```

3. Create and setup .env file

```
make a copy of .env.example
$ copy .env.example .env
$ php artisan key:generate
put database credentials in .env file and set the following parameters with values
GOOGLE_API_KEY =
SAFE_BROWSING_CLIENT_ID =
SAFE_BROWSING_CLIENT_VERSION =
```

4. Serving application
```
For Local
$ php artisan serve
$ npm run hot
```

