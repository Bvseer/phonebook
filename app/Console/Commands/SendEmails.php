<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends mail to those who have a birthday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // User::where('birthdate')
        // Mail::to($request->user())->send(new MailableClass);
        return Command::SUCCESS;
    }
}
