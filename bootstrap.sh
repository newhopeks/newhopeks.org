#!/usr/bin/env bash

# Apache
apt-get update
apt-get install -y apache2
rm -rf /var/www
ln -fs /vagrant /var/www
# Enable mod_rewrite
a2enmod rewrite
# Restart apache
service apache2 restart

apt-get install -y libapache2-mod-php5

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
