<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteOldUserSessions extends Command
{
    protected $signature = 'sessions:delete';
    protected $description = 'Delete old user sessions';

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

        // Delete sessions older than the threshold
        DB::table('user_sessions')->where('created_at', '<=', $timeThreshold)->delete();

        $this->info('Old user sessions deleted successfully.');
    }

    //docker exec -it src-laravel.test-1  php /var/www/html/artisan schedule:run >> /dev/null 2>&1;
    //cd /Users/inkpnc/Desktop/webtech/src/ && sail artisan schedule:run >> /dev/null 2>&1
}
