<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mail;
use App\User;
use App\Institution;
use App\Message;
use App\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
    	$user = Auth::user();

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
            $validator = Validator::make(['email' => $request['email'], 'phone' => $request['phone']], ['email' => 'required|email|max:255|unique:users', 'phone' => 'required']);

            if (!$validator->fails()) {
                $user = Auth::user();
                $user->email = $request['email'];
                $user->contact->phone = $request['phone'];
                $user->update();
                $user->contact->update();
            }
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
        try{
            $request->emails = preg_split('`\s`', $request->emails);
            foreach ($request->emails as $email) {
                $result = self::createAdmin($email);
                if($result['success']){
                    Mail::send('email-templates.admin-confirmation', ['user' => $result['user'], 'password' => $result['password']], function ($m) use ($email) {
                        $m->from('i.tconsult99@gmail.com', 'Dorminator');
                        $m->to($email)->subject('Dorminator are nevoie de atenția ta!');
                    });
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'S-a trimis invitație de înregistrare catre toate adresele de email',
            ]);

        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ]);
        }

    }

    public function createAdminInterface($email)
    {
        return view('admin-signup',['email' => $email]);
    }

    public function deleteUser($email)
    {
        $user = User::where('email', '=', $email)->first();
        if($user->contact){
            $user->contact->delete();
        }
        $user->delete();
        print_r('Șters');
        return;
    }

    public static function createAdmin($email)
    {
        $user = User::where('email', '=', $email)->first();
        $result = ['success' => false, 'already_exist' => false, 'created' => false];
        if($user){
            $result['already_exist'] = true;
            $result['user'] = $user;
            return $result;
        }
        $tmp_password = self::generateRandomString();
        $user = new User();
        $user->email = $email;
        $user->username = self::createUserName($email,true);
        $user->has_temp_password = true;
        $user->password =  Hash::make($tmp_password);
        $user->is_admin = true;
        $user->is_super_admin = false;
        $user->save();

        $contact = new Contact();
        $user->contact()->save($contact);

        $result['success'] = true;
        $result['created'] = true;
        $result['user'] = $user;
        $result['password'] = $tmp_password;
        return $result;
    }

    public function changePasswordTemplate(Request $request){
        if ($request->isMethod('get')){
            $user = Auth::user();
            return view('change-password', ['user' => $user,]);
        }elseif ($request->isMethod('post')){
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'success' => true,
                'url' => '/profile',
            ]);
        }else{
            abort(500, "Nu aveți dreptul pentru a accesa această pagină");
        }

    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function createUserName($name, $fromEmail = false)
    {
        if($fromEmail){
            return substr($name, 0, strpos($name, '@'));
        }
        return $name;
    }



    public function createTestMessage(Request $request)
    {
        $message = new Message();
        $message->to = 1;
        $message->from = 2;
        $message->subject = 'Test subiect';
        $message->message = 'Test continut mesaj';
        $message->save();

        die('Trimis');
    }

    public function addStudentsTemplate(Request $request)
    {
        if ($request->isMethod('get')){
            $user = Auth::user();
            $has_institutions = Institution::first();
            $can_insert = true;
            if(is_null($has_institutions)){
                $can_insert = false;
            }
            $students = Contact::orderBy('grade', 'desc')->paginate(5);
            $students->withPath('/add-students');
            return view('students/add-student', ['user' => $user, 'can_insert' => $can_insert, 'students' => $students]);
        }elseif ($request->isMethod('post')){
            $institution = Institution::where('code', '=', $request->code)->first();

            if(is_null($institution)){
                return response()->json([
                    'success' => false,
                    'message' => 'Nu există nici o instituție cu codul furnizat.',
                ]);
            }

            $user = new User();
            $user->username = str_replace(' ','.',strtolower($request->name));
            $user->password = Hash::make($user->username.floatval($request->grade));
            $user->has_temp_password = true;
            if (trim($request->email) == ''){
                $domain = '';
                $domain_names = explode(' ',$institution->name);
                foreach ($domain_names as $dom){
                    $domain .= strtolower($dom[0]);
                }
                $user->email = $user->username.'@'.$domain.'.com';
                $user->has_temp_email = true;
            }else{
                $user->email = $request->email;
                $user->has_tmp_email = false;
            }
            $user->is_admin = false;
            $user->is_super_admin = false;
            $user->save();

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->grade = floatval($request->grade);
            $contact->cnp = $request->cnp;
            $contact->phone = $request->phone;
            $contact->sex = $request->sex;
            $contact->institution_code = $institution->code;
            $user->contact()->save($contact);

            return response()->json([
                'success' => true,
                'message' => 'Studentul '. $contact->name . ' a fost adăugat în baza de date',
            ]);
        }

    }

}

