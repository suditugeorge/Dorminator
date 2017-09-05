<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dorm;

class DormsController extends Controller
{
    public function getDormsTemplate(Request $request)
    {
        $user = Auth::user();
        $dorms = Dorm::orderBy('id','asc')->paginate(20);
        return view('dorms/dorms', ['user' => $user, 'dorms' => $dorms]);
    }
}
