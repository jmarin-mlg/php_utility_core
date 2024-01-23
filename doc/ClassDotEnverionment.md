## Clase: DotEnvironment

La clase `DotEnvironment` implementa la interfaz `DotEnvInterface` y proporciona funcionalidad para cargar y acceder a las variables de entorno desde un archivo
`.env`.

### Métodos

- `__construct(string $filePath)`: Constructor de la clase. Recibe la ruta del
archivo .env a cargar.
- `load(): void`: Carga las variables de entorno desde el archivo .env
especificado.
- `get(string $key, string $default = null): ?string`: Obtiene el valor de una
variable de entorno específica. Si la variable no existe, se devuelve el valor predeterminado especificado.
- `clearData(): void`: Limpia los datos almacenados en la clase.

Uso básico:

```php
// Crear una instancia de DotEnvironment
$dotenv = new DotEnvironment('/var/www/html/.environment/.env_production');

// Cargar las variables de entorno
$dotenv->load();

// Obtener el valor de una variable de entorno
$host = $dotenv->get('DB_HOST');

// Utilizar la variable de entorno
echo "Host: $host";
```

[Volver al índice de clases...](README.md)
