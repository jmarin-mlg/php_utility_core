## Clase: Template

La clase `Template` implementa la interfaz `TemplateInterface` y proporciona una funcionalidad para crear una instancia de `Illuminate\View\Factory`, que es la
clase principal para trabajar con plantillas en `Laravel` utilizando el motor
`Blade`.

Esta clase permite crear una instancia de `Factory` para trabajar con plantillas
de vista utilizando el motor `Blade` de `Laravel`. Al utilizar esta clase,
puedes especificar las ubicaciones de las plantillas y la carpeta de caché para personalizar el comportamiento de la generación de vistas.

### Métodos

- `getViewFactory(): Factory`: Este método simplemente devuelve la instancia de
`Factory` almacenada en la propiedad `$viewFactory`.

Uso básico:

```php
$template = new Template('view', 'cache');

echo $template->getViewFactory()->make('index')->with('name', 'John')->render();
```

```html
<!-- Plantilla index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Binvenido</title>
</head>
<body>
    <header>
        <!-- Aquí puedes incluir el código HTML para tu encabezado común -->
        Hola {{ $name }}
    </header>

    <main>
        <!-- Aquí se incluirá el contenido de cada página -->
        @yield('content')
    </main>

    <footer>
        <!-- Aquí puedes incluir el código HTML para tu pie de página común -->
    </footer>
</body>
</html>
```

[Volver al índice de clases...](README.md)
