<?php

namespace App\Console\Commands;

use App\Movement;
use App\Room;
use Illuminate\Console\Command;

class SortStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dorminator:sortStudents';

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
        $rooms_counter = Room::whereRaw('occupation < capacity')->count();
        $bar = $this->output->createProgressBar($rooms_counter);

        $rooms = Room::whereRaw('occupation < capacity')->cursor();
        foreach ($rooms as $room){
            if($room->occupation == 0){
                $highest_movement = Movement::where('dorm_code', '=', $room->dorm_code)->where('institution_code', '=', 'INFO')->where('has_been_parsed', '=', false)->orderBy('grade', 'desc')->first();
                if(!is_null($highest_movement)){
                    $movements = Movement::where('dorm_code', '=', $room->dorm_code)->where('institution_code', '=', 'INFO')->where('has_been_parsed', '=', false)->where('sex', '=', $highest_movement->sex)->orderBy('grade', 'desc')->limit($room->capacity)->get();
                    $occupation = $room->occupation;
                    foreach ($movements as $movement){
                        $movement->has_been_parsed = true;
                        $movement->acceptance = true;
                        $movement->room_id = $room->id;
                        $movement->save();
                        $this->info('The movement of user '. $movement->user_id. ' has been accepted in room '. $room->id. ' in dorm '. $room->dorm_code);
                        $occupation++;
                    }
                    $room->occupation = $occupation;
                    $room->save();
                }
            }else{
                $highest_movement = Movement::where('room_id', '=', $room->id)->where('dorm_code', '=', $room->dorm_code)->where('institution_code', '=', 'INFO')->where('has_been_parsed', '=', true)->orderBy('grade', 'desc')->first();
                if(!is_null($highest_movement)){
                    $limit = $room->capacity - $room->occupation;
                    $movements = Movement::where('dorm_code', '=', $room->dorm_code)->where('institution_code', '=', 'INFO')->where('has_been_parsed', '=', false)->where('sex', '=', $highest_movement->sex)->orderBy('grade', 'desc')->limit($room->capacity)->get();
                    if(!is_null($movements)){
                        foreach ($movements as $movement){
                            $movement->has_been_parsed = true;
                            $movement->acceptance = true;
                            $movement->room_id = $room->id;
                            $movement->save();
                            $this->info('The movement of user '. $movement->user_id. ' has been accepted in room '. $room->id. ' in dorm '. $room->dorm_code);
                            $room->occupation = $room->occupation + 1;
                        }
                        $room->save();
                    }
                }
            }
            $bar->advance();
        }

        $bar->finish();

    }
}
