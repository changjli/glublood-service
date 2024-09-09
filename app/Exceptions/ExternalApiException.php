<?php

namespace App\Exceptions;

use App\Classes\ResponseTemplate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExternalApiException extends Exception
{
    public function __construct($message = 'External API error.', $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function report(): void
    {
        //
    }

    public function render(Request $request)
    {
        return ResponseTemplate::sendResponseError(message: $this->message, code: $this->code);
    }
}
