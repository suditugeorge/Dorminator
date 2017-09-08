<?php

namespace App\Http\Controllers;
use App\Contact;
use App\Dbstat;
use App\User;
use App\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home()
    {
    	$has_root = User::where('username', '=', 'root-dorminator')->first();
    	
    	if(is_null($has_root)){
    		self::initializeRoot();
    		self::updateDBStat();
    	}

        if(Auth::check()){
            return redirect()->route('dashboard');
        }

    	return view('home');
    }

    public static function updateDBStat()
    {
        $stat = new Dbstat();
        $stat->start = false;
        $stat->end = false;
        $stat->can_operate = true;
        $stat->save();
    }

    public function login(Request $request)
    {
        try{
            $username = $request['username'];
            $password = $request['password'];
            $remember = $request['remember'];

            $user = User::where('username', '=', $username)->first();
            
            if ($user === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aceast utilizator nu există.',
                    'field' => 'username',
                ]);
            }elseif(Auth::attempt(['username' => $username, 'password' => $password], $remember)){
                $user = Auth::user();
                if($user->has_temp_password){
                    return response()->json([
                        'success' => false,
                        'url' => 'change-password',
                    ]);
                }
                return response()->json([
                    'success' => true,
                ]); 
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Parola este greșită',
                    'field' => 'password',
                ]);            
            }

        }catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
                ]);    
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public static function getBasicInfo()
    {
        $user = Auth::user();

        if($user->is_super_admin){
            $basic_info = "Acest cont este deținut de un Super Admin";
        }elseif($user->is_admin){
            $basic_info = "Acest cont este deținut de un Admin";
        }else{
            $basic_info = "Acest cont este deținut de un utilizator";
        }

        return $basic_info;
    }

    public static function initializeRoot()
    {

        DB::transaction(function () {
            $userAdmin = new User();
            $userAdmin->email = 'suditugeorge94@gmail.com';
            $userAdmin->username = 'root-dorminator';
            $userAdmin->has_temp_password = False;
            $userAdmin->password = Hash::make("MulteCarti");
            $userAdmin->is_admin = False;
            $userAdmin->is_super_admin = True;
            $userAdmin->save();

            $contact = new Contact();
            $contact->name = 'George';
            $contact->sex = 'M';

            $userAdmin->contact()->save($contact);

        });
    }
}
