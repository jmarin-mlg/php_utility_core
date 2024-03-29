# Librería de utilidades PHP

## Configuración inicial con APACHE

Primero de todo, tenemos que crear en nuestra máquina local, los directorios que
van a alojar los ficheros `.env`. Estos ficheros van a guardar los datos de
acceso a las bases de datos.

1. Ejecutar este comando en la terminal:

```bash
mkdir -p /var/www/html/.environment
```

2. Asignamos como propietario a nuestro usuario y como grupo a `www-data`. Esto
se hace para Apache pueda acceder a estas carpetas y pueda obtener los datos del
fichero de entorno sin problemas:

```bash
sudo chown -R $USER:www-data /var/www/html/.environment
```

3. Le damos permisos de lectura, escritura y ejecución al propietario y al
grupo. Además, los directorios deben tener establecido el atributo "sticky bit"
(bit pegajoso). Esto asegura que solo el propietario del archivo (y el
superusuario) pueda cambiar el dueño y el grupo de los archivos dentro del
directorio. El sticky bit se establece agregando el número octal "1":

```bash
chmod -R 1770 /var/www/html/.environment
```

4. Crear el fichero de entorno predeterminado:

```bash
touch /var/www/html/.environment/.env_production
```

5. Editar el fichero creado con tu editor preferido (vim, nano, VSCode, etc.)

```bash
vim /var/www/html/.environment/.env_production
```

6. Insertar el contenido con los datos reales de la base de datos:

```ini
DB_HOST=<host>
DB_PORT=<port>
DB_DATABASE=<db_name>
DB_USERNAME=<user>
DB_PASSWORD=<password>
```

En el directorio `.environment` podemos guardar otros ficheros `.env` como
podría ser uno que conectara con la base de
datos de desarrollo `.env_development` u otro que conectará a una base de datos
para tests `.env_tests`.

7. Una vez creados los ficheros de conexiones `.env` les damos únicamente
permisos de lectura para el propietario y para el grupo. También asignamos
usuario y grupo a estos ficheros, el grupo siempre será `www-data` para
que los ficheros puedan ser accesibles también por el usuario `www-data` de
`Apache`:

```bash
sudo find /var/www/html/.environment/ -type f -name '.env_*' -exec chmod 440 {} \; -exec chown $USER:www-data {} \;
```

## Instrucciones de utilización de la librería

Esta librería puede ser utilizada mediante composer o de manera independiente en
cualquier proyecto existente.

Recomiendo hacerlo mediante composer, dado que es más cómodo.

También podemos dockerizar esta librería como un servicio y conectarlo a una red
de otros contenedores para que compartan este servicio y puedan utilizarlo.

## Instrucciones para utilizar mediante composer

Pasos a seguir para utilizar de manera pública el repositorio de GitHub:

1. Crear fichero `composer.json` en el directorio raíz de nuestro proyecto:

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/jmarin-mlg/php_utility_core.git"
        }
    ],
    "require": {
        "jmarin/php-utility-core": "dev-master"
    }
}
```

2. En el fichero `index.php` o en cualquier otro donde se quiera hacer uso de la
librería, insertar este código:

```php
require_once __DIR__ . '/vendor/autoload.php';

use UtilityCore\Controllers\UtilityCore;

$utils = new UtilityCore();

// Manejar respuestas del servidor con código 200 y mensaje personalizado
$utils->getUtil(1, 200, 'Operación exitosa');
```

3. ¡Importante! Leer la documentación de las clases que esta disponible en
[`README`](./doc/README.md) en el directorio `/doc` para conocer el funcionamiento
de tales clases.

4. Por último, ejecutar en la terminal el siguiente comando:

```bash
composer install
```

## Script `phpcs.sh`

Se recomienda encarecidamente hacer uso de este script para mantener el código
estandarizado y limpio. Sigue el estandar PSR-12 y el script se encarga de
arreglar automaticamente los warnings que encuentre el código y mostrará los
errores que encuentra y que requieren arreglos manuales por parte del
programador.

Debes crear un fichero llamado `phpcs.sh` o como lo quieras llamar en el raíz
del sitio, con el siguiente comando:

```bash
touch phpcs.sh
```

Y debes colocar en este fichero el siguiente código:

```sh
#!/bin/sh

# Set the color variable
green='\033[1;32m'
# Clear the color after that
clear_color='\033[0m'

clear

echo ""
echo ""
echo "${green}Corrigiendo warnings de formato PHP${clear_color}"
echo "${green}-----------------------------------${clear_color}"

phpcbf --extensions=php --ignore=*/vendor/*,*/cache/*,*/view/* --standard=PSR12 .

echo ""
echo ""
echo "${green}Obteniendo errores que no pueden corregirse automáticamente${clear_color}"
echo "${green}-----------------------------------------------------------${clear_color}"

phpcs --extensions=php --ignore=*/vendor/*,*/cache/*,*/view/* --standard=PSR12 .
```

Para ejecutar el script desde la terminal, escribe el siguiente comando si usas
linux:

```bash
sh phpcs.sh
```

### Instalación PHP CodeSniffer (PHPCS) en Debian/Ubuntu

1. Abre una terminal.

2. Asegúrate de tener Composer instalado en tu sistema. Si no lo tienes
instalado, puedes hacerlo ejecutando el siguiente comando:

```bash
sudo apt-get install composer
```

3. Instala PHPCS globalmente utilizando Composer. Ejecuta el siguiente comando:

```bash
sudo composer global require "squizlabs/php_codesniffer=*"
```

Este comando descargará e instalará PHPCS y sus dependencias.

4. Verifica que PHPCS se haya instalado correctamente. Puedes ejecutar el
siguiente comando para verificar la versión instalada:

```bash
phpcs --version
```

Deberías ver la versión de PHPCS en la salida de la terminal.

5. Configura el PATH para poder ejecutar PHPCS desde cualquier ubicación en la
terminal. Agrega la siguiente línea al archivo `.bashrc` o `.bash_profile` en tu
directorio de inicio (si aún no existe):


```bash
export PATH="$PATH:$HOME/.composer/vendor/bin"
```

Guarda el archivo y cierra y vuelve a abrir la terminal para que los cambios
surtan efecto.

Con estos pasos, deberías tener PHPCS instalado y listo para usar en tu sistema
Debian/Ubuntu. Puedes utilizar PHPCS para realizar análisis de estándares de
codificación en proyectos PHP y asegurarte de que siguen las mejores prácticas
de codificación.
