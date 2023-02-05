<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BirthDayWish;
use App\Models\User;

class AutoBirthdayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:birthdaywish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends birthday wishes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereMonth('birthdate', date('m'))
            ->whereDay('birthdate', date('d'))
            ->get();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new BirthDayWish($user));
            }
        }

        return Command::SUCCESS;
    }
}
