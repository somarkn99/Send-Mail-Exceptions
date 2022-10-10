<?php

namespace somarkn99\SendMailExceptions\Exceptions;

use App\Mail\ExceptionMail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;
use Mail;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array>
     */
    protected $dontReport = [

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
            $this->sendEmail($e);
        });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendEmail(Throwable $exception)
    {
        try {
            $exceptionData['message'] = $exception->getMessage();
            $exceptionData['file'] = $exception->getFile();
            $exceptionData['line'] = $exception->getLine();
            $exceptionData['trace'] = $exception->getTrace();

            $exceptionData['url'] = request()->url();
            $exceptionData['body'] = request()->all();
            $exceptionData['ip'] = request()->ip();

            $email = env('SUPPORT_EMAIL');

            Mail::to($email)->send(new ExceptionMail($exceptionData));
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }
}
