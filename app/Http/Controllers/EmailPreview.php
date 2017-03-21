<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailPreview extends Controller
{
    public function adminConfrimation($email)
    {
    	$url = 'http://dorminator.ro/add-admin-user/'.$email;
    	return view('email-templates/admin-confirmation', ['url' => $url]);
    }
}
