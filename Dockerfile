FROM ubuntu:16.04

LABEL Author="Victor Gustavo e Lucas Eliaquim"

ENV PATH ${PATH}:/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/sbin:/usr/local/bin
ENV PROJECT_FOLDER /home/prokect-folder

RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y software-properties-common \
	apache2 \
	curl \
	language-pack-en-base

#Add php repository ondrej
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get upgrade -y

# Install php and its libraries
RUN apt -y install php7.2 \
	php7.2-mbstring \
	php7.2-xml \
	php7.2-curl \
	php7.2-mysql \
	php7.2-pgsql \
	php7.2-imagick \
	php7.2-zip \
	php7.2-mongodb \
	libxrender1 \
	libfontconfig1 \
	libxtst6 

# Install nodejs and npm
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g n npm@latest
RUN n 8.*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Apachelinker script
COPY apachelinker.sh /usr/local/bin/apachelinker

# Apache config
RUN a2enmod rewrite
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
WORKDIR /home/project-folder
