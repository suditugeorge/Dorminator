<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DormsController;
use App\User;
use App\Movement;

class CreateTestMovementsCascade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dorminator:createTestMovementsCascade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $avaible_dorms = DormsController::getAvailableDorms();
        $users_number = User::where('is_admin', '=', false)->where('is_super_admin', '=', false)->count();
        $bar = $this->output->createProgressBar($users_number);
        $users = User::where('is_admin', '=', false)->where('is_super_admin', '=', false)->cursor();

        foreach ($users as $user){
            $movement = new Movement();
            $movement->user_id = $user->id;
            $movement->institution_code = $user->contact->institution_code;
            shuffle($avaible_dorms);
            $movement->dorm_code = implode(',', $avaible_dorms);
            $movement->acceptance = false;
            $movement->has_been_parsed = false;
            $movement->sex = $user->contact->sex;
            $movement->grade = $user->contact->grade;
            $movement->room_id = -1;
            $movement->save();
            $this->info('Added movement for student '.$user->contact->name);
            $bar->advance();
        }

        $bar->finish();
    }
}
