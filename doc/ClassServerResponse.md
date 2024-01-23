## Clase: ServerResponse

La clase `ServerResponse` implementa la interfaz `ServerResponseInterface` y
proporciona métodos estáticos para enviar respuestas HTTP con códigos de estado
y mensajes personalizados.

### Métodos

- `getResponse(int $code, string $message = null): void`: Método principal para
obtener una respuesta HTTP. Recibe un código de estado y un mensaje opcional.
Dependiendo del código de estado proporcionado, se llamará al método
correspondiente para enviar la respuesta apropiada.
- `respondServerError(string $message = 'Internal Server Error'): void`: Envía
una respuesta HTTP con un código de estado 500 (Error interno del servidor) y un
mensaje personalizado.
- `respondNotFound(string $message = 'Not Found'): void`: Envía una respuesta
HTTP con un código de estado 404 (No encontrado) y un mensaje personalizado.
- `respondForbidden(string $message = 'Forbidden'): void`: Envía una respuesta
HTTP con un código de estado 403 (Prohibido) y un mensaje personalizado.
- `respondOk(string $message = 'OK'): void`: Envía una respuesta HTTP con un
código de estado 200 (OK) y un mensaje personalizado.

Uso básico:

```php
// Obtener una respuesta HTTP de error interno del servidor
ServerResponse::getResponse(500, 'Se produjo un error en el servidor.');

// Obtener una respuesta HTTP de página no encontrada
ServerResponse::getResponse(404, 'La página solicitada no se encontró.');

// Obtener una respuesta HTTP de acceso prohibido
ServerResponse::getResponse(403, 'Acceso denegado.');

// Obtener una respuesta HTTP exitosa
ServerResponse::getResponse(200, 'La operación se realizó con éxito.');
```

[Volver al índice de clases...](README.md)
