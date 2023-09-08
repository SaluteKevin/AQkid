<?php

namespace App\Exceptions;


use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomException extends HttpException
{
    protected $redirectTo;
    protected $message;

    public function __construct(string $message, int $statusCode = 302, string $redirectTo = null)
    {
        parent::__construct($statusCode, $message);

        $this->redirectTo = $redirectTo;
        $this->message = $message;
    }

    public function render($request)
    {
        return redirect($this->redirectTo ?: url()->previous())
            ->with('message', $this->message)
            ->withInput($request->input())
            ->withErrors(['error' => $this->message]);
            
    }

    //example
    // use App\Exceptions\CustomException;
    // throw new CustomException('dont have this id', 302, route('login'));
    // throw new CustomException('dont have this id', 302);
}
