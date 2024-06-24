# Sistema de Gestión de Notas

## Descripción
Este proyecto es un sistema de gestión de notas desarrollado como trabajo práctico integrador de Diseño de Sistemas. Permite a los usuarios cargar datos de estudiantes, materias y notas a través de archivos CSV, XLS o XLSX y visualizar esos datos en la plataforma. Este sistema utiliza Laravel, Maatwebsite/Excel para la importación de archivos y maneja los datos utilizando un patrón DTO (Data Transfer Object) y patrón Strategy.

## Colaboradores
Este proyecto fue desarrollado por:
- Agustín Durán
- Gloria Villasanti Martínez

## Requisitos Previos
Antes de instalar y configurar el proyecto, asegurate de tener instalados los siguientes software:
- PHP >= 7.3
- Composer
- Node.js y npm
- Un servidor de base de datos como MySQL
- Laravel 8.x

## Instalación

### Clonar el Repositorio
Primero, cloná el repositorio en tu máquina local usando Git:

```
git clone https://github.com/agustinduran/laravel-login-dss-project.git
cd laravel-login-dss-project
```


### Configuración del Entorno
Copiá el archivo `.env.example` a `.env` y modificá las variables de entorno necesarias (por ejemplo, las credenciales de la base de datos):

```
cp .env.example .env
```

### Instalar Dependencias
Instalá todas las dependencias de Composer y npm:

```
composer install
npm install
npm run dev
```

### Generar Clave de Aplicación
Generá la clave de la aplicación Laravel:

```
php artisan key
```

### Ejecutar Migraciones
Ejecutá las migraciones para crear las tablas en la base de datos:

```
php artisan migrate
```


## Uso
Para iniciar el servidor de desarrollo y acceder a la aplicación, ejecutá:

```
php artisan serve
```

Ingresá a `http://localhost:8000` en el navegador para ver la aplicación.