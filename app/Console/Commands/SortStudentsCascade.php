<?php

namespace App\Console\Commands;

use App\Dorm;
use App\Movement;
use App\Room;
use Illuminate\Console\Command;

class SortStudentsCascade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dorminator:sortStudentsCascade';

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
        $movements_counter = Movement::where('has_been_parsed', '=', false)->where('acceptance', '=', false)->orderBy('grade', 'desc')->count();
        $bar = $this->output->createProgressBar(count($movements_counter));
        $movements = Movement::where('has_been_parsed', '=', false)->where('acceptance', '=', false)->orderBy('grade', 'desc')->cursor();
        foreach ($movements as $movement) {
            if(is_numeric($movement->room_id) && $movement->room_id != -1){
                continue;
            }
            $dorm_codes = explode(',', $movement->dorm_code);
            $can_be_accepted = false;
            foreach ($dorm_codes as $dorm_code) {
                $available_room = self::getAvailableRoom($dorm_code,$movement->institution_code, $movement->sex);
                if(is_null($available_room)){
                    continue;
                }
                $can_be_accepted = true;
                break;
            }

            if($can_be_accepted){
                $movement->room_id = $available_room->id;
                $movement->has_been_parsed = true;
                $movement->acceptance = true;
                $movement->save();
                self::updateRoom($available_room);
                $this->info('Student '.$movement->user_id .' has been accepted in '. $available_room->dorm_code);
            }else{
                $movement->has_been_parsed = true;
                $movement->acceptance = false;
                $movement->save();
                $this->info('Student '.$movement->user_id .' has not been accepted');
            }
            $bar->advance();
        }
        $bar->finish();
    }

    public static function getAvailableRoom($code, $institution_code, $sex)
    {

        $room_counter = Room::where('dorm_code', '=', $code)->where('institution_code','=', $institution_code)->whereRaw('occupation < capacity')->count();
        if(is_null($room_counter) || $room_counter == 0){
            return null;
        }
        $rooms = Room::where('dorm_code', '=', $code)->where('institution_code','=', $institution_code)->whereRaw('occupation < capacity')->cursor();
        foreach ($rooms as $room){
            if($room->occupation == 0){
                return $room;
            }elseif ($room->occupation < $room->capacity){
                $best_movement = Movement::where('room_id', '=', $room->id)->where('has_been_parsed', '=', true)
                                            ->where('acceptance', '=', true)->orderBy('grade', 'desc')->first();
                if(is_null($best_movement)){
                    continue;
                }
                if($sex == $best_movement->sex){
                    return $room;
                }
            }
        }


        return null;
    }

    public static function updateRoom($room)
    {
        $room->occupation = $room->occupation + 1;
        $room->save();
        return;
    }
}
