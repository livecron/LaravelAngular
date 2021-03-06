<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof  ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        if ($exception instanceof NotFoundHttpException) {
            return  response()->json(['data'=> null, 'message' => 'El metodo no es la correcta', 'state' => false, 'satusCode'=> 404], 404);

        }
        if( $exception instanceof MethodNotAllowedHttpException) {
            return  response()->json(['data'=> null, 'message' => 'El metodo no es la correcta', 'state' => false, 'satusCode'=> 400], 400);
        }

        if ( $exception instanceof QueryException) {
            return  response()->json(['data'=> null, 'message'=>' Error en sql', 'state' =>false,  'statusCode' => 409], 409);
           // return response()
        }
        if ( $exception instanceof \HttpException) {
            return  response()->json(['data'=> null, 'message' => $exception->getMessage(), 'state' => false, 'satusCode'=> $exception->getSatusCode()], $exception->getSatusCode());
        }
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }
        return  response()->json(['data'=> null, 'message' => 'Error en el servicor', 'state' => false, 'satusCode'=> 500], 500);

    }

    public function convertValidationExceptionToResponse(ValidationException $e, $request) {
        $errores = $e->validator->errors()->getMessages();
        return response()->json(['error' => $errores], 422);
    }
}
