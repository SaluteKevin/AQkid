<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteOldPasswordResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:delete';
    protected $description = 'Delete old Password reset tokens';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timeThreshold = Carbon::now()->subHours(1);

        // Delete tokens older than the threshold
        DB::table('password_reset_tokens')->where('created_at', '<=', $timeThreshold)->delete();

        $this->info('Old token deleted successfully.');
    }
}
