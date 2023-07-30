#!/bin/sh

Red='\033[0;31m'          # Red
Green='\033[0;32m'        # Green

echo ""
echo "***********************************************************"
echo " Starting the 🚚TRU}{DR1V3R🚛 ENV                          "
echo "***********************************************************"

set -e

## Check if the artisan file exists
if [ -d ./truckdriver_vue/dist ]; then
    echo "${Green} The TruckDriver UI is already built"
    docker-compose down docker-compose up -d app redis-web && docker-compose ps
else
    docker-compose up ui_build
    echo  "${Red} artisan file not found"
fi
