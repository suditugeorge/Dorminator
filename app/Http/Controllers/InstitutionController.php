<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Institution;

class InstitutionController extends Controller
{
    public function addInstitution(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = Auth::user();
            $institutions = Institution::orderBy('created_at', 'desc')->paginate(20);
            return view('institutions/add-institution', ['user' => $user, 'institutions' => $institutions]);
        } elseif ($request->isMethod('post')) {
            $institution = Institution::where('code', '=', $request->code)->first();
            if (!is_null($institution)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Această instituție există deja',
                ]);
            }

            $institution = new Institution();
            $institution->name = $request->name;
            $institution->code = $request->code;
            $institution->description = $request->description;

            $institution->save();
            return response()->json([
                'success' => true,
                'message' => 'A fost introdusă instituția ' . $institution->name,
            ]);
        }

    }

    public function deleteInstitution(Request $request)
    {
        $institution = Institution::find($request->id);
        if(is_null($institution)){
            abort(500, 'Această instituție nu există');
        }
        $institution->delete();
        return redirect('/add-institution');
    }
}
