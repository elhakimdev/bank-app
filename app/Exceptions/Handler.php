<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            if ($e instanceof AuthenticationException) {
                return $this->error('Unauthenticated action', 401);
            }
            if ($e instanceof AuthorizationException) {
                return $this->error('This action is unauthorized', 403);
            }
            if ($e instanceof ModelNotFoundException) {
                $modelID        = $e->getIds();
                $model          = explode('\\', $e->getModel());
                $getmessage     = 'Entry : ' . end($modelID) . ' for Model : ' . end($model) . ' Was Not Found';
                return $this->error('Sorry we can not perform this action', 404, $getmessage);
            }
            if ($e instanceof ValidationException) {
                $errors         = collect($e->errors());
                return $this->error('Please, check your input and go back with valid data', 422, $errors);
            }
        };
        return parent::render($request, $e);
    }
}
