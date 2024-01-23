<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use UtilityCore\Interfaces\MailerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerCG implements MailerInterface
{
    private $mailer;

    public function __construct(array $data)
    {
        $secure = PHPMailer::ENCRYPTION_SMTPS;

        if ($data['secure'] != 'ssl') {
            $secure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        $this->mailer = new PHPMailer(true);

        $this->mailer->isSMTP();
        $this->mailer->Host       = $data['host'];
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = $data['username'];
        $this->mailer->Password   = $data['password'];
        $this->mailer->SMTPSecure = $secure;
        $this->mailer->Port       = $data['port'];
    }

    public function sendMail(array $data): void
    {
        try {
            $this->mailer->setFrom($data['senderEmail'], $data['senderName']);
            $this->mailer->addAddress($data['recipientEmail'], $data['recipientName']);

            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $data['subject'];
            $this->mailer->Body = $data['content'];

            $this->mailer->send();
        } catch (Exception $e) {
            throw new Exception(
                "There was an error sending the email:
                {$this->mailer->ErrorInfo}"
            );
        }
    }
}
