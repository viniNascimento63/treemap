# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Copia os arquivos do projeto para o diretório do Apache
COPY ./treemap/ /var/www/html/

# Habilita o módulo rewrite do Apache, se necessário
RUN a2enmod rewrite