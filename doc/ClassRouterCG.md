## Clase: RouterCG

La clase `RouterCG` implementa la interfaz `RouterInterface` y proporciona una funcionalidad para crear una instancia de `Illuminate\Routing\Router`, que es la
clase principal para trabajar con rutas en `Laravel`.

### Métodos

- `getRouter(): Router`: Este método simplemente devuelve la instancia de
`Router` almacenada en la propiedad `$router`.

Uso básico:

```php
use UtilityCore\Controllers\RouterCG;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

$routerGC = new RouterCG();
$router   = $routerGC->getRouter();

// Definir las rutas
$router->get('/hello', function () {
    return '¡Hola desde Laravel Routing!';
});

// Ruta para capturar rutas no encontradas
$router->fallback(function () {
    return new Response('Acceso prohibido', 403);
});

// Procesar la solicitud
$request = Request::capture();
$response = $router->dispatch($request);

// Enviar la respuesta
$response->send();
```

[Volver al índice de clases...](README.md)
