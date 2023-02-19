# pi_centreExcursionista
Este repositorio concentra la información y código para el desarrollo de la aplicación web para el *Centro Excursionista de Tavernes de la Valldigna*.

## Guía de uso
Nuestra aplicación no está subida a ningún dominio online, tampoco nuestra API. Por lo tanto se deben seguir los siguientes pasos para poder el correcto uso.
1. Iniciar Docker.
2. Iniciar VisualStudioCode y realizar una importación del repositorio
- `git clone https://github.com/arvodb/pi_centreExcursionista.git`.
3. File > New Window > /bbdd. Esperar a que aparezca el desplegable y pulsar sobre el botón **reopen container**
4. Ejecutar los siguietes comandos en la consola.
- `composer install`
- `php bin/console doctrine:database:create`
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`
5. Abrir **localhost:5000**
6. Desde el explorador de archivos navegar a ' /bbdd/exports-imports ' e insertar *dummyinsert.sql* en la base de datos desde phpmyadmin
7. Desde la consola con el proyecto de symfony ejecutar => `symfony serve`
8. Podemos volver a la ventana con el proyecto:
- Abriremos en la consola la carpeta '/src/codigoAngular/'.
- Ejecutaremos `npm install`.
- Ejecutaremos `ng serve`.
9. Ya podemos abrir en nuestro navegador la ruta ' localhost:4200 '

## Guía de navegación
Nuestra aplicación cuenta con una parte renderizada en cliente y otra en servidor.
Para acceder a la parte cliente podemos usar:
- USER: `arvo`
- PASS: `Adios1234`

La parte administrador se renderiza desde el servidor. Esta actualmente inahabilitada para entrar mediante la página de login. 
Sin embargo se puede acceder mediante la siguietne ruta ' localhost:8000 '
