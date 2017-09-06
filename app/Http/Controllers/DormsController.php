<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dorm;
use App\Room;
use App\Institution;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Excel;

class DormsController extends Controller
{
    public $message = '';

    public function getDormsTemplate(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = Auth::user();
            $dorms = Dorm::orderBy('created_at', 'desc')->paginate(20);
            $can_insert = true;
            if (is_null(Dorm::first())) {
                $can_insert = false;
            }
            return view('dorms/dorms-template', ['user' => $user, 'dorms' => $dorms, 'can_insert' => $can_insert]);
        } elseif ($request->isMethod('post')) {
            $dorm = Dorm::where('code', '=', $request->code)->first();
            if (!is_null($dorm)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aceast cămin există deja',
                ]);
            }

            $dorm = new Dorm();
            $dorm->name = $request->name;
            $dorm->code = $request->code;
            $dorm->description = $request->description;

            $dorm->save();
            return response()->json([
                'success' => true,
                'message' => 'A fost introdus căminul ' . $dorm->name,
            ]);
        }
    }

    public function uploadRoomsFile(Request $request)
    {
        $file = $request->file('roomTemplate');
        $extension = $request->file('roomTemplate')->getClientOriginalExtension();
        $name = 'Rooms'. time().'.'.$extension;
        Storage::disk('files')->put($name, File::get($file));
        $path = public_path() . '/files/'.$name;
        Excel::load($path, function($reader) {
            $reader->each(function($row) {
                $result = self::createRoom($row);
                if ($result['success']){
                    $this->message .= "\nAu fost adăugate camerele de la ". $row->camera_de_la . " pană la ". $row->camera_pana_la . " a căminului cu codul ". $row->cod_camin;
                }else{
                    $this->message .= "\n". $result['message'];
                }

            });

        });
        $current_user = Auth::user();
        MessageController::sendMessageFromAdmin($current_user->id, $this->message, 'Adăugare camere');
        return redirect('/dorms');
    }

    public static function createRoom($room)
    {
        $dorm = Dorm::where('code', '=', trim($room->cod_camin))->first();
        if(is_null($dorm)){
            return ['success' => false, 'message' => 'Nu există cămin cu codul '. $room->cod_camin];
        }
        $institution = Institution::where('code', '=', $room->cod_facultate)->first();
        if(is_null($institution)){
            return ['success' => false, 'message' => 'Nu există instituție cu codul '. $room->cod_facultate];
        }

        $room->camera_de_la = intval($room->camera_de_la);
        $room->camera_pana_la = intval($room->camera_pana_la);
        for ($i = $room->camera_de_la; $i<=$room->camera_pana_la; $i++){
            $new_room = new Room();
            $new_room->dorm_code = $room->cod_camin;
            $new_room->room_number = $i;
            $new_room->capacity = $room->capacitate;
            $new_room->institution_code = $room->cod_facultate;

            $new_room->save();
        }
        return ['success' => true];

    }

    public static function getAvailableDorms()
    {
        $dorms = Dorm::all();
        $available_codes = [];
        foreach ($dorms as $dorm){
            $room = Room::where('dorm_code', '=', $dorm->code)->where('institution_code', '=', 'INFO')->whereRaw('occupation < capacity')->first();
            if(!is_null($room)){
                $available_codes[] = $dorm->code;
            }
        }

        return $available_codes;
    }
}
