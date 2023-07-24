#!/bin/bash

# Build the Nginx image from Dockerfile.nginx
docker build -t peter2002tran/nginx-image-1 -f Dockerfile.nginx .

# Build the PHP image from Dockerfile.php
docker build -t peter2002tran/php-image-1 -f Dockerfile.php .

echo "Build complete!"
