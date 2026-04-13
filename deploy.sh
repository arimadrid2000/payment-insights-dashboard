#!/bin/bash

# Ejecutar migraciones
# El flag --force es obligatorio en producción
php artisan migrate --force

# Iniciar Apache en primer plano (comando original de Docker)
apache2-foreground
