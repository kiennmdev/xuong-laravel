<?php

namespace App\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(['error' => 'Data not found.'], 404);
    }
}
