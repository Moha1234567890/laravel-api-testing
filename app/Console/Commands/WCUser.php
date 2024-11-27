<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class WCUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wc:user {--verified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        if($this->option('verified')) {
            echo User::where('email_verified_at', '<>', null)->count();
        } else {
            echo User::count();
        }
    }
}
