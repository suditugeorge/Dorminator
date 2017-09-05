<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dorm;

class DormsController extends Controller
{
    public function getDormsTemplate(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = Auth::user();
            $dorms = Dorm::orderBy('created_at', 'desc')->paginate(20);
            return view('dorms/dorms-template', ['user' => $user, 'dorms' => $dorms]);
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
}
