<?php
namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->renderable(function (ValidationException $e, $request)
        {
            return response()->json([
                'message' => 'The received parameters are invalid.',
                'errors' => $e->validator->getMessageBag()
            ], 422);
        });
    }
}
