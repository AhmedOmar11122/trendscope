# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت امتدادات PHP المطلوبة ومكتبات النظام
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إعداد مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ كل ملفات المشروع إلى الحاوية
COPY . .

# تثبيت الاعتمادات عبر Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# إعداد صلاحيات مجلدات التخزين والبووتستراب
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# نسخ إعدادات Apache لتوجيه الموقع إلى مجلد public
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# تفعيل mod_rewrite
RUN a2enmod rewrite

# فتح البورت 80
EXPOSE 80

# أمر التشغيل الأساسي
CMD ["apache2-foreground"]
