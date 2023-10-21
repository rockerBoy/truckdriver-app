#!/bin/sh

# inspired by https://gist.github.com/themightychris/51a63a1c2bf6f3be82c9e85481106fa0

Red='\033[0;31m'          # Red
Green='\033[0;32m'        # Green

echo ""
echo "${Green}***********************************************************"
echo "${Green} Starting the 🚚TRU}{DR1V3R🚛 APP                          "
echo "${Green}***********************************************************"

set -e

## start nginx and php in the background, kill both on exit
echo ""
echo "${Green}***********************************************************"
echo " Starting NGINX                                            "
echo "${Green}***********************************************************"
nginx -g 'daemon off;' 2>&1 &
NGINX_PID=$!

echo ""
echo "${Green}***********************************************************"
echo "${Green} Starting PHP-FPM                                          "
echo "${Green}***********************************************************"

php-fpm --daemonize
PHP_FPM_PID=$!

## initialize config cache
php artisan config:cache

## watch nginx and php in an ongoing loop
while :
do
    kill -0 $NGINX_PID 2> /dev/null
    NGINX_STATUS=$?

    kill -0 $PHP_FPM_PID 2> /dev/null
    PHP_FPM_STATUS=$?

    if [ "$TRAPPED_SIGNAL" = "false" ]; then
        if [ $NGINX_STATUS -ne 0 ] || [ $PHP_FPM_STATUS -ne 0 ]; then
            if [ $NGINX_STATUS -eq 0 ]; then
                kill -15 $NGINX_PID;
                wait $NGINX_PID;
            fi
            if [ $PHP_FPM_STATUS -eq 0 ]; then
                kill -15 $PHP_FPM_PID;
                wait $PHP_FPM_PID;
            fi

            exit 1;
        fi
    else
       if [ $NGINX_STATUS -ne 0 ] && [ $PHP_FPM_STATUS -ne 0 ]; then
            exit 0;
       fi
    fi

    # trigger laravel scheduler every 60s
    php artisan schedule:run --verbose --no-interaction &

    sleep 60
done
exec "$@"
