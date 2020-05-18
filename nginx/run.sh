#!/usr/bin/env bash


echo "====================================="
echo "||                                 ||"
echo "||         0     0    0 0    0     ||"
echo "||        0 0    00   0 0    0     ||"
echo "||       0   0   0  0 0 000000     ||"
echo "||      0000000  0   00 0    0     ||"
echo "||     0       0 0    0 0    0     ||"
echo "||                                 ||"
echo "||                                 ||"
echo "||  0000      0     0    0 0    0  ||"
echo "|| 0         0 0    00   0 0    0  ||"
echo "|| 0        0   0   0  0 0 000000  ||"
echo "|| 0       0000000  0   00 0    0  ||"
echo "||  0000  0       0 0    0 0    0  ||"
echo "||                                 ||"
echo "||                                 ||"
echo "||       Copyright © 2019          ||"
echo "||                                 ||"
echo "====================================="


composer install
php artisan key:generate
php artisan config:clear
php artisan config:cache
php-fpm