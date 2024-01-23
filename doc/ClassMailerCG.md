## Clase: MailerCG

La clase `MailerCG` implementa la interfaz `MailerInterface` y permite enviar
correos electrónicos utilizando la biblioteca PHPMailer.

### Métodos

- `__construct(array $data): void`: Constructor de la clase `MailerCG`. Recibe
un array asociativo con la configuración del servidor SMTP para la conexión.

- `sendMail(array $data): void`: Método para enviar correos electrónicos. Recibe
un array asociativo con la siguiente información:
  - `senderEmail`: Dirección de correo del remitente.
  - `senderName`: Nombre del remitente.
  - `recipientEmail`: Dirección de correo del destinatario.
  - `recipientName`: Nombre del destinatario.
  - `subject`: Asunto del correo.
  - `content`: Contenido del correo en formato HTML.

  El método lanza una excepción `Exception` si ocurre un error durante el envío
  del correo.

Uso básico:

```php
use UtilityCore\Controllers\MailerCG;

// Configuración del servidor SMTP
$smtpConfig = [
    'host'     => 'smtp.example.com',
    'username' => 'user@example.com',
    'password' => 'password',
    'secure'   => 'tls',
    'port'     => 587,
];

$mailer = new MailerCG($smtpConfig);

// Datos del correo
$emailData = [
    'senderEmail'    => 'sender@example.com',
    'senderName'     => 'Nombre Remitente',
    'recipientEmail' => 'recipient@example.com',
    'recipientName'  => 'Nombre Destinatario',
    'subject'        => 'Asunto del correo',
    'content'        => '<p>Contenido del correo en formato HTML</p>',
];

try {
    $mailer->sendMail($emailData);
    echo 'El correo se ha enviado correctamente.';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $e->getMessage();
}
```

[Volver al índice de clases...](README.md)
