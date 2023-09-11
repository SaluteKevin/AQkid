<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomException extends HttpException
{
    protected $statusCode;
    protected $message;

    public function __construct(string $message, int $statusCode = 422)
    {
        parent::__construct($statusCode, $message);

        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message,
        ], $this->statusCode);
    }

    //example
    // use App\Exceptions\CustomException;
    // throw new CustomException('dont have this id', 302, route('login'));
    // throw new CustomException('dont have this id', 302);


    // ทำไว้เผื่อแต่ใช้ abort ดีกว่า
}
