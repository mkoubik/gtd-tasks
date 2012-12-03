#!/bin/sh
composer install
chmod o+w temp log
cp config/config.local.neon.example config/config.local.neon
