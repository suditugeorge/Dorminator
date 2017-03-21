<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mail;
use App\User;
use App\UserAdmin;
use App\UserNormal;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
    	$user = Auth::user();

        if($user->is_super_admin || $user->is_admin){
            $details = UserAdmin::where('user_type_id', '=', $user->user_type_id)->first();
        }else{
            
        }

    	return view('dashboard/profile', ['user' => $user]);
    }


    public function changeProfilePhoto(Request $request)
    {
    	$user = Auth::user();
    	$file = $request->file('profilePicture');

    	if(!$file){
    		return view('dashboard/profile', ['user' => $user, 'error_message' => "Există o problemă cu fișierul încarcat"]);
    	}

        $rules = [
            'file' => 'required | mimes:jpeg,jpg,png ',
        ];
        $validator = Validator::make(['file' => $file], $rules);
        if (!$validator->fails()) {
            $file_name = $user->id . '.jpg';
            Storage::disk('users')->put($file_name, File::get($file));
            return redirect()->route('dashboard');
        } else {
        	$error_text = "";
           	foreach ($validator->errors() as $error) {
           		$error_text .= $error;
           	}
           	return view('dashboard/profile', ['user' => $user, 'error_message' => $error_text]);
        }
    }

    public function updateProfile(Request $request)
    {
        try{
            $user = Auth::user();

            $user->name = $request['name'];
            $user->degree = $request['degree'];
            $user->year_of_study = $request['year_of_study'];
            $user->gender = $request['gender'];
            $user->update();
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ]);               
        }
        return response()->json([
            'success' => true,
        ]); 
    }

    public function adminGetUsers()
    {
        $user = Auth::user();

        return view('dashboard/users', ['user' => $user,]);
    }

    public function addAdmins(Request $request)
    {
        $request->emails = preg_split('`\s`', $request->emails);
        foreach ($request->emails as $email) {
            $url = 'http://dorminator.ro/add-admin-user/'.$email;

            Mail::send('email-templates.admin-confirmation', ['url' => $url], function ($m) use ($email) {
                $m->from('i.tconsult99@gmail.com', 'Dorminator');
                $m->to($email)->subject('Dorminator are nevoie de atenția ta!');
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'S-a trimis invitație de înregistrare catre toate adresele de email',
        ]);  
    }

    public function createAdminInterface($email)
    {
        return view('admin-signup',['email' => $email]);
    }

    public function adminSignUp(Request $request)
    {

        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->is_super_admin = false;
            $user->is_admin = true;
            $user->gender = "Female";
            $user->degree = "Admin";
            $user->year_of_study = 4;
            $user->grade = 10.00;
            $user->save();

            return response()->json([
                'success' => true,
            ]);         
            
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ]); 
        }

    }
}
