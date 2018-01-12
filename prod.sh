#!/usr/bin/env bash

# optimize autoload
composer dump-autoload --optimize --classmap-authoritative --no-dev

# compress assets
ASSETS_DIR="public/build"

# gzip assets
bash assets_gzip.sh $ASSETS_DIR

# brotli assets
bash assets_brotli.sh $ASSETS_DIR

# set rights for "www-data" user
chmod -R a-rwx,u+rwX,g+rX $ASSETS_DIR && chown www-data:www-data -R $ASSETS_DIR