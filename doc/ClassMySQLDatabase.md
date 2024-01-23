## Clase: MySQLDatabase

La clase `MySQLDatabase` implementa la interfaz `DatabaseInterface` y
proporciona funcionalidad para conectarse a una base de datos MySQL y realizar
operaciones en ella.

### Métodos

- `__construct(object $dotenv)`: Constructor de la clase. Recibe una instancia
de la clase `DotEnvironment` para obtener los datos de conexión a la base de
datos desde el archivo .env.
- `connectORM(): void`: Establece la conexión a la base de datos MySQL
utilizando los datos de conexión proporcionados usando el componente `Eloquent`
de `Laravel`.
- `connect(): void`: Establece la conexión a la base de datos MySQL utilizando
los datos de conexión proporcionados.
- `disconnect(): void`: Cierra la conexión a la base de datos.
- `getPDO(): object`: Obtiene la instancia de PDO utilizada para la conexión a
la base de datos.
- `transaction(string $sql, array $params = []): void`: Este método se utiliza
para realizar los `insert`, `update` o `delete`.
- `getArrayAssoc(string $sql, string $method = 'fetch', array $params = [])`:
Ejecuta una consulta SQL y devuelve los resultados en forma de matriz
asociativa. Puede especificarse el método (`fetch` o `fetchAll`) para obtener un
solo registro o múltiples registros, respectivamente. Se pueden proporcionar
parámetros para consultas preparadas.

Uso básico:

```php
// Crear una instancia de MySQLDatabase pasando una instancia de DotEnvironment
$database = new MySQLDatabase($dotenv);

// Conectarse a la base de datos
$database->connect();

// Ejecutar una consulta y obtener los resultados
$sql = "SELECT * FROM users";
$results = $database->getArrayAssoc($sql, 'fetchAll');

// Desconectarse de la base de datos
$database->disconnect();
```

Otro ejemplo de uso utilizando el `ORM` de `Laravel`:

```php
// Crear una instancia de MySQLDatabase pasando una instancia de DotEnvironment
$database = new MySQLDatabase($dotenv);

// Conectarse a la base de datos usando `Eloquent`
$database->connectORM();

// Las clases de los modelos creados es recomendable guardarlo en el directorio
// `model`
// y después incluirlos en este punto mediante un require_once o mejor
// todavía...
// Se le asigna un `namespace` a la clase, por ejemplo:
// namespace YourLibrarie\Models;
// Y después se hace uso de la clase mediante `use`, por ejemplo:
// use YourLibrarie\Models\User;
// Crea un modelo y realiza una consulta
class User extends Illuminate\Database\Eloquent\Model {
    protected $table = 'usuarios';
}

$users = User::where('codigo', '=', 1)->get();

foreach ($users as $user) {
    echo $user->email . '<br>';
}
```

[Volver al índice de clases...](README.md)
