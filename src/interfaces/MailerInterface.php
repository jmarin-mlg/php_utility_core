<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

interface MailerInterface
{
    public function sendMail(array $data): void;
}
