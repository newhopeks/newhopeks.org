#!/usr/bin/env bash

# Apache
apt-get update
apt-get install -y apache2
rm -rf /var/www
ln -fs /vagrant /var/www

# MySQL
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get update
apt-get install -y mysql-server

# PHP
apt-get install -y software-properties-common python-software-properties
add-apt-repository ppa:ondrej/php5-oldstable
apt-get update
apt-get upgrade
apt-get install -y php5

# PHP extensions
apt-get install -y php5-mysql php5-gd
