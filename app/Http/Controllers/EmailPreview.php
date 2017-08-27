<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EmailPreview extends Controller
{
    public function adminConfrimation($email)
    {
        $user = User::where('email', '=', $email)->first();
    	return view('email-templates/admin-confirmation', ['user' => $user]);
    }
}
