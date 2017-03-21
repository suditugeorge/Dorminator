<?php

namespace App\Http\Controllers;
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
    	}

        if(Auth::check()){
            return redirect()->route('dashboard');
        }

    	return view('home');
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
            $userAdmin = new UserAdmin();
            $userAdmin->email = 'suditugeorge94@gmail.com';
            $userAdmin->user_type_name = 'Super Administrator';
            $userAdmin->save();

            $user = new User();
            $user->user_type_id = $userAdmin->user_type_id;
            $user->username = 'root-dorminator';
            $user->password = Hash::make("rootdorminator");
            $user->has_temp_password = false;
            $user->is_super_admin = true;
            $user->is_admin = false;
            $user->is_normal_user = false;
            $user->save();

        });
    }
}
