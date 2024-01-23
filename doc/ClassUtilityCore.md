## Clase: UtilityCore

La clase `UtilityCore` implementa la interfaz `UtilityCoreInterface` y
proporciona métodos para acceder al contenedor de dependencias y a la base de
datos MySQL, así como para realizar diferentes utilidades.

### Métodos

- `__construct(string $env = null)`: Constructor de la clase. Recibe una ruta
opcional para cargar un archivo `.env`. Si no se proporciona, se utilizará la
ruta predeterminada `/var/www/html/.environment/.env_production`.
- `getContainer(): object`: Devuelve el contenedor de dependencias (`Container`)
utilizado por la clase.
- `getDb(): object`: Devuelve la instancia de la base de datos MySQL
(`MySQLDatabase`) utilizada por la clase.
- `getUtil(int $util, ...$args): void`: Método para acceder a diferentes
utilidades. Recibe un valor entero que representa la utilidad a utilizar y
argumentos adicionales según corresponda.

Uso básico:

```php
// Crear una instancia de UtilityCore
$utils = new UtilityCore();

// Obtener el contenedor de dependencias
$container = $utils->getContainer();

// Obtener la instancia de la base de datos MySQL
$db = $utils->getDb();

// Manejar respuestas del servidor con código 200 y mensaje personalizado
$utils->getUtil(1, 200, 'Operación exitosa');
```

[Volver al índice de clases...](README.md)
