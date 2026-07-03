#!/usr/bin/env bash
# Exit on error
set -o errexit

# Run migrations using the dedicated direct migration host variable
php artisan migrate --force