#!/bin/sh
set -e

PORT="${PORT:-10000}"
sed "s/__RENDER_PORT__/${PORT}/g" /etc/nginx/default.conf.template > /etc/nginx/sites-enabled/default
nginx -t

cd /var/www/html

php artisan storage:link --force 2>/dev/null || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec /usr/bin/supervisord -n
