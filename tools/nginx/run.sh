#!/bin/bash

set -euo pipefail

nginx -c $PWD/nginx.conf || { echo "Error with nginx."; exit 1; }
# Comment out -D option if you don't want to run php-fpm in the background.
php-fpm -D || { echo "Error with php-fpm."; exit 1; }
