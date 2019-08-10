# LaraTweet | Simple Tweet system with Laravel


## How to get the project up and running on your development enviroment

- please, make sure to run the following commands first

```sh
composer install
```

- Change your file `.env.example` to `.env` 
```shell script
cp .env.example .env
```

- then run this command:

```sh
php artisan key:generate
```

- run migrations

```shell script
php artisan migrate
```

- install passport access keys
```
php artisan passport:install
```

 ##### Main system API's endpoints:
 
 ```shell script
    POST      api/v1/login
    POST      api/v1/register

    POST      api/v1/Tweets
    DELETE    api/v1/tweets/{tweet}

    POST      api/v1/user/{user}/follow
    
    GET       api/v1/timeline
```


Thank You!
