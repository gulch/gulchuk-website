#!/usr/bin/env bash

# Laravel optimizations
# php artisan config:cache && php artisan route:cache && php artisan optimize --force

ASSETS_DIR="public"

# gzip assets
bash assets_gzip.sh $ASSETS_DIR