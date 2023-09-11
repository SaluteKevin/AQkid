<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tokenId;

    /**
     * Create a new job instance.
     */
    public function __construct($tokenId)
    {
        $this->tokenId = $tokenId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = PasswordResetToken::find($this->tokenId);

        Mail::to($token->email)->send(new ResetPasswordMail($token->token));
    }
}
