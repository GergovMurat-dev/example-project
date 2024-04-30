<?php

namespace App\DTO\Mail;

use App\DTO\Common\BaseDTO;
use Illuminate\Mail\Mailable;

class MailDTO extends BaseDTO
{
    public function __construct(
        public readonly ?string  $email,
        public readonly Mailable $mail
    )
    {
    }
}
