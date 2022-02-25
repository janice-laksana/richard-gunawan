<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Models\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = User::find(Auth::id());

        // $query = "SELECT us.user_id, us.user_username, us.user_picture, max(t.cnt) as cnt
        // FROM users us
        // JOIN (SELECT u.user_id, u.user_username, u.user_picture, sum(case ca.chat_has_read when 0 then 1 else 0 end) as cnt
        // FROM users u
        // JOIN chat ca on ca.chat_sendder = u.user_id
        // WHERE ca.chat_receiver=".$account->id." GROUP BY u.id, u.username, u.user_picture
        // UNION
        // SELECT u.user_id, u.user_username, u.user_picture, 0 as cnt
        // FROM users u
        // JOIN chat c on c.chat_receiver = u.user_id
        // WHERE c.chat_sendder=".$account->id.") t on us.user_id=t.user_id
        // GROUP BY us.id, us.username, us.user_picture";
        // $alluser = DB::raw($query);
        $alluser = User::all();

        return view('chat', [
            'account' => $account,
            'alluser' => $alluser
        ]);
    }

    public function send(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $sender = Auth::id();
        $receiver = $request->receiver;
        $message = $request->message;
        if ($message == 'Kamu sudah dapat memulai chat') {
            $temp = Chat::where([
                ['chat_sendder','=',$sender],
                ['chat_receiver','=',$receiver]
            ])->orWhere([
                ['chat_sendder','=',$receiver],
                ['chat_receiver','=',$sender]
            ])->count();
            if ($temp<1) {
                DB::table('chat')->insert([
                    'chat_sendder' => $sender,
                    'chat_receiver' => $receiver,
                    'chat_message' => $request->message,
                    'chat_time' => date("Y-m-d H:i:s"),
                    'chat_has_read' => 0
                ]);
            }
        }else {
            if ($message == 'baca') {
                Chat::where([
                    ['chat_sendder','=',$receiver],
                    ['chat_receiver','=',$sender]
                ])->update(['chat_has_read' => 1]);
            }else{
                DB::table('chat')->insert([
                    'chat_sendder' => $sender,
                    'chat_receiver' => $receiver,
                    'chat_message' => $request->message,
                    'chat_time' => date("Y-m-d H:i:s"),
                    'chat_has_read' => 0
                ]);
            }
            $data = Chat::where([
                ['chat_sendder','=',$sender],
                ['chat_receiver','=',$receiver]
            ])->orWhere([
                ['chat_sendder','=',$receiver],
                ['chat_receiver','=',$sender]
            ])->get();
            if (count($data)>0) {
                event(new MessageSend($data));
            }
        }
    }
}
