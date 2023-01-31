<?php
namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (ValidationException $e)
        {
            return response()->json([
                'message' => 'The received parameters are invalid.',
                'errors' => $e->validator->getMessageBag()
            ], 422);
        });

        $this->renderable(function (NotFoundHttpException $e)
        {
            return response()->json([
                'message' => 'Resource not found.'
            ], 404);
        });
    }
}
