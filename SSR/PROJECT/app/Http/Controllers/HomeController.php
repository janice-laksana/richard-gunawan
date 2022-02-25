<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd(Auth::user());
        if (Auth::id()) {
            $auth_id = Auth::id();
            $auth = User::find($auth_id);
            $recent_jasa = Jasa::where('user_id','!=',$auth_id)->where('jasa_status', 1)->orderBy('jasa_publish_date', 'desc')->get();
            $kate_reco = DB::table('recommend')->where('recommend_id_user', $auth_id)->orderBy('recommend_jumlah', 'desc')->get();
            if (count($kate_reco) > 0) {
                $query="";
                $ctr_union = 0;
                foreach ($kate_reco as $value) {
                    if ($ctr_union <= 0) {
                        $query = $query."SELECT * FROM jasa WHERE jasa_status = 1 && user_id != ".$auth_id." && kat_skill_id = ".$value->recommend_id_kate;
                    } else {
                        $query = $query." UNION SELECT * FROM jasa WHERE jasa_status = 1 && user_id != ".$auth_id." && kat_skill_id = ".$value->recommend_id_kate;
                    }
                }
                $recommend_jasa = DB::raw($query);
            }else {
                $recommend_jasa = Jasa::where('user_id','!=',$auth_id)->where('jasa_status', 1)->orderBy('jasa_publish_date', 'desc')->get();
            }
        }else{
            $auth = (object) ['id' => -1];
            $recent_jasa = Jasa::all(); $recommend_jasa = Jasa::all();
        }

        return view('home', [
            'auth' => $auth,
            'recentjasa' => $recent_jasa,
            'recojasa' => $recommend_jasa,
            'request'=>$request
        ]);
    }

    public function resetrecommend()
    {
        DB::table('recommend')->where('recommend_id_user', Auth::id())->delete();
    }
}
