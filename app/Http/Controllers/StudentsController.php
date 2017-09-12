<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Excel;
use PDF;
use App\User;
use App\Contact;
use App\Institution;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class StudentsController extends Controller
{
    public $message = '';

    public function uploadStudentsFile(Request $request)
    {
        $file = $request->file('studentTemplate');
        $extension = $request->file('studentTemplate')->getClientOriginalExtension();
        $name = 'Students'. time().'.'.$extension;
        Storage::disk('files')->put($name, File::get($file));
        $path = public_path() . '/files/'.$name;
        Excel::load($path, function($reader) {
            $reader->each(function($row) {
                // Loop through all rows
                $result = self::createStudent($row);
                if($result['success']){
                    $this->message .= "\nA fost adăugat ". $row->nume_prenume;
                }else{
                    $this->message .= "\n". $result['message'];
                }

            });

        });
        $current_user = Auth::user();
        MessageController::sendMessageFromAdmin($current_user->id, $this->message, 'Adăugare studenți');
        return redirect('/add-students');
    }

    public static function createStudent($student)
    {
        try{
            $institution = Institution::where('code', '=', $student->cod_falcultate)->first();

            if(is_null($institution)){
                return ['success' => false, 'message' => 'Nu există instituție cu codul '. $student->cod_falcultate];
            }

            if(trim($student->email) != ''){
                $user = User::where('email', '=', $student->email);
                if(!is_null($user)){
                    return ['success' => false, 'message' => 'Există deja studentul cu adresă '.$student->email];
                }
            }

            $user = new User();
            $base = preg_replace('/[^a-z\d ]+/i', '', strtolower($student->nume_prenume));
            $base = preg_replace('/\s+/', ' ',$base);
            $base = str_replace(' ','.',$base);
            $user->username = $base.substr(strval(time()), -4);
            $user->password = Hash::make($user->username);
            $user->has_temp_password = true;
            if (trim($student->email) == ''){
                $domain = '';
                $domain_names = explode(' ',$institution->name);
                foreach ($domain_names as $dom){
                    $domain .= strtolower($dom);
                }
                $user->email = $user->username.'@'.$domain.'.com';
                $user->has_temp_email = true;
            }else{
                $user->email = $student->email;
                $user->has_temp_email = false;
            }
            $user->is_admin = false;
            $user->is_super_admin = false;
            $user->save();

            $contact = new Contact();
            $contact->name = $student->nume_prenume;
            $contact->grade = floatval($student->media_finala);
            $contact->cnp = $student->cnp;
            $contact->phone = $student->telefon;
            $contact->sex = $student->sex;
            $contact->institution_code = $institution->code;
            $user->contact()->save($contact);

            return ['success' => true];

        }catch(\Exception $e) {
            $user = Auth::user();
            MessageController::sendMessageToAdmin($user->id, $e, 'EROARE');
            return ['success' => false, 'message' => 'Am întâmpinat o eroare la procesarea unui student. A fost trimis un mesaj catre admin pentru rezolvarea problemei'];
        }

    }

    public function getPDF(Request $request)
    {
        $students = User::where('has_temp_password', '=', true)->where('is_admin', '=', false)->where('is_super_admin', '=', false)->get();
        return view('students/studentsPDF86', ['students' => $students]);
    }
}
