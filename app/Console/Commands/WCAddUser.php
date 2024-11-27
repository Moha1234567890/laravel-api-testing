<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class WCAddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wc:user-add {count=1}';

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
        for($i=0; $i<$this->argument('count'); $i++) {
            User::factory()->create();
        }

        echo "user created sucessfullly";

    }
}
