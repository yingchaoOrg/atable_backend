#
#

FROM php:7.4-cli

#更新apt-get源 使用163的源
RUN echo "deb https://mirrors.aliyun.com/debian/ bullseye main non-free contrib" > /etc/apt/sources.list && \
    echo "deb-src https://mirrors.aliyun.com/debian/ bullseye main non-free contrib " >> /etc/apt/sources.list  && \
    echo "deb https://mirrors.aliyun.com/debian-security/ bullseye-security main " >> /etc/apt/sources.list && \
    echo "deb-src https://mirrors.aliyun.com/debian-security/ bullseye-security main " >> /etc/apt/sources.list && \
    echo "deb https://mirrors.aliyun.com/debian/ bullseye-updates main non-free contrib " >> /etc/apt/sources.list && \
    echo "deb-src https://mirrors.aliyun.com/debian/ bullseye-updates main non-free contrib " >> /etc/apt/sources.list && \
    echo "deb https://mirrors.aliyun.com/debian/ bullseye-backports main non-free contrib " >> /etc/apt/sources.list && \
    echo "deb-src https://mirrors.aliyun.com/debian/ bullseye-backports main non-free contrib " >> /etc/apt/sources.list



ENV REFRESH_DATE 2

RUN apt-get update
RUN apt-get install -y vim wget zip zlib1g-dev autoconf automake libtool git libc-ares-dev
# 安装 oniguruma
ENV ORIGURUMA_VERSION=6.9.8

RUN wget https://github.com/kkos/oniguruma/archive/v${ORIGURUMA_VERSION}.tar.gz -O oniguruma-${ORIGURUMA_VERSION}.tar.gz \
    && tar -zxvf oniguruma-${ORIGURUMA_VERSION}.tar.gz \
    && cd oniguruma-${ORIGURUMA_VERSION} \
    && ./autogen.sh \
    && ./configure \
    && make \
    && make install

RUN docker-php-ext-install bcmath mbstring pdo pdo_mysql zip;docker-php-ext-enable pdo pdo_mysql;

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb



# 安装swoole
RUN pecl install -D 'enable-sockets="no" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="yes" enable-swoole-json="no" enable-swoole-curl="yes" enable-cares="yes"' swoole-4.8.12 \
    && docker-php-ext-enable swoole

# pcntl
RUN docker-php-ext-install   pcntl \
    && docker-php-ext-enable pcntl

# 安装composer 
RUN wget https://mirrors.aliyun.com/composer/composer.phar \
	&& mv composer.phar /usr/local/bin/composer \
	&& chmod +x /usr/local/bin/composer \
	&& composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/


COPY php74.ini /usr/local/etc/php/conf.d/

#  安装 protobuf
RUN pecl install protobuf && docker-php-ext-enable  protobuf

EXPOSE 80
WORKDIR /var/www/html/
COPY src /var/www/html
RUN chmod 777 -R runtime
RUN composer config secure-http false
RUN composer install

CMD php ./bin/hyperf.php start