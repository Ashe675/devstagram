#!/bin/bash

set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data /var/www/html/public/storage
chmod -R 755 /var/www/html/public/storage

echo "🚀 Iniciando Apache..."
exec apache2-foreground