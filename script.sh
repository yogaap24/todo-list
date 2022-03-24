#!/bin/bash
echo "===Running Application==="
set -e

php artisan cache:clear
php artisan config:cache
#php artisan telescope:install

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php "$@"
fi

exec "$@"

apache2-foreground
