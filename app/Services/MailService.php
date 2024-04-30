<?php

namespace App\Services;

use App\DTO\Mail\MailDTO;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function send(MailDTO $mailDTO): ServiceResult
    {
        try {
            Mail::to($mailDTO->email)->send($mailDTO->mail);
            return ServiceResult::createSuccessResult();
        } catch (\Throwable $exception) {
            return ServiceResult::createErrorResult('Не удалось отправить письмо');
        }
    }
}
