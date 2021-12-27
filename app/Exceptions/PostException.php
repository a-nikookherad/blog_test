<?php

namespace App\Exceptions;

use Exception;

class PostException extends Exception
{
    public function report()
    {
        Log::info($this->getMessage(), [
            "file:" => $this->getFile(),
            "line:" => $this->getLine(),
            "status_code:" => $this->getCode(),
        ]);
    }

    public function render($request)
    {
        return abort(400,$this->getMessage());
    }
}
