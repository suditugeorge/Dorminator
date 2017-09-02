<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function messagesTemplate(Request $request)
    {
        $user = Auth::user();
        $messages = $user->messages()->orderBy('created_at', 'desc')->paginate(20);
        $messages->withPath('/messages');

        //$messages = Message::where('to','=',$user->id)->orderBy('created_at', 'desc')->get();
        //$messages = DB::table('messages')->where('to', '=', 1)->get();
        return view('messaging/messages', ['user' => $user,'messages' => $messages]);
    }

    public function deleteMessage(Request $request)
    {
        $user = Auth::user();
        $id = $request->id;
        $message = Message::find($id);
        if (!$message){
            abort(404);
        }

        if ($message->to != $user->id){
            abort(500);
        }
        $message->delete();
        return redirect('/messages');
    }

    public function messageViewTemplate(Request $request)
    {

        $id = $request->id;
        $message = Message::find($id);
        if (!$message){
            abort(404);
        }
        $user = Auth::user();
        if ($message->to != $user->id){
            abort(500);
        }

        $from = User::find($message->from);

        return view('messaging/message-view', ['user' => $user, 'message' => $message, 'from' => $from]);
    }

    public function newMessage(Request $request)
    {
        if ($request->isMethod('get')){
            $user = Auth::user();
            return view('messaging/new-message', ['user' => $user]);
        }elseif ($request->isMethod('post')){
            $to = User::where('username', '=', $request->username)->first();
            if(is_null($to)){
                return response()->json([
                    'success' => false,
                    'message' => 'Acest user nu există',
                ]);
            }
            $user = Auth::user();

            $message = new Message();
            $message->to = intval($to->id);
            $message->from = intval($user->id);
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();

            return response()->json([
                'success' => true,
                'message' => 'Mesajul a fost trimis',
            ]);
        }

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
}
