<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated user redirect.
     */
    

protected function unauthenticated($request, AuthenticationException $exception)
{
    $guard = $exception->guards()[0] ?? null;

    switch ($guard) {
        case 'admin':
            $login = route('admin.login');
            break;
        default:
            $login = route('login');
            break;
    }

    return $request->expectsJson()
        ? response()->json(['message' => $exception->getMessage()], 401)
        : redirect()->guest($login);
}

}
