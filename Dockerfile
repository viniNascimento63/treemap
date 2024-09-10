FROM php:7.4-apache

# Copiar os arquivos do seu projeto para o container
COPY ./ /var/www/html/treemap

# Habilitar o mod_rewrite
RUN a2enmod rewrite

# Reiniciar o Apache para aplicar mudanças
RUN service apache2 restart

