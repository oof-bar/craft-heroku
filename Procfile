web: vendor/bin/heroku-php-nginx -C nginx_app.conf web
worker: ./craft queue/listen --verbose
release: ./craft migrate/all
