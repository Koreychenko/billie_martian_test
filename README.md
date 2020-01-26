# Instructions

## Set up the application

* Up environment using:

```
docker-compose up
```

* Install dependencies: 

```
docker-compose exec -ti fpm sh -c "cd /var/www/html && composer install"
```

* Run tests:

```
docker-compose exec -ti fpm sh -c "cd /var/www/html && vendor/bin/phpspec run"
```

## Using the application

In browser open following URLs:

```
http://localhost/mars
```
This will return date and time on Mars for current time on Earth

```
http://localhost/mars?date=2019-01-01T10:10:10
```
This will return date and time on Mars for specified time on Earth
