FROM php:8.1

# Update packages
RUN apt-get update -qq

# Install PHP and composer dependencies
RUN apt-get install -qq git curl libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev libzip-dev mariadb-client build-essential  openssl gcc g++ make

# setup node js source will be used later to install node js
RUN curl --silent --location https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get install -y nodejs

# Clear out the local repository of retrieved package files
RUN apt-get clean

# Install needed extensions
# Here you can install any other extension that you need during the test and deployment process
RUN docker-php-ext-install pcntl pdo pdo_mysql zip exif

# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~2.8"


#git.sitelbra.net:5050/sitelbra/chamadosinterno:latest
#
# docker login -u deploy-token1 -p a8m_x2paxVqxJTyzmF23 git.sitelbra.net:5050
# docker build -t git.sitelbra.net:5050/sitelbra/chamadosinterno .
# docker push git.sitelbra.net:5050/sitelbra/chamadosinterno
#
#
#