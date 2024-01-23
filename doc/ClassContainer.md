## Clase: Container

La clase `Container` representa un contenedor de dependencias utilizado para
resolver y manejar las dependencias de un sistema. Proporciona métodos para
vincular abstracciones con sus implementaciones concretas y para resolver
instancias de objetos.

### Métodos

- `bind(string $abstract, $concrete): void`: Este método se utiliza para
vincular una abstracción con una implementación concreta en el contenedor.
- `resolve(string $abstract, ...$args): object`: Este método se utiliza para
resolver una instancia de la abstracción especificada.
- `clearBindings(): void`: Este método se utiliza para limpiar todas las
vinculaciones existentes en el contenedor.

Uso básico:

```php
// Crear una instancia del contenedor
$container = new Container();

// Vincular una abstracción con una implementación concreta
$container->bind('DatabaseInterface', 'Database');

// Resolver una instancia de la abstracción
$database = $container->resolve('DatabaseInterface');

// Utilizar la instancia resuelta
$database->query('SELECT * FROM users');
```

[Volver al índice de clases...](README.md)
