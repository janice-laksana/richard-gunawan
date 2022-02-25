<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\RequestBuyer;
use App\Models\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        $countuser = User::count();$countjasa = Jasa::where('jasa_status','=',1)->count();
        $counttrans = Transaksi::count();
        $countprofit = Transaksi::sum('transaksi_price');
        $topcategory = DB::table('transaksi')
            ->join('jasa', 'transaksi.jasa_id', '=', 'jasa.jasa_id')
            ->join('kategori', 'kategori.category_id', '=', 'jasa.kat_skill_id')
            ->selectRaw('sum(jasa.kat_skill_id) as jumlah, kategori.category_name as name')
            ->orderBy('jumlah', 'desc')->groupBy('name')->get();
        $alltrans = Transaksi::all();
        return view('admin.index', [
            'countuser' => $countuser,
            'countjasa' => $countjasa,
            'counttrans' => $counttrans,
            'countprofit' => $countprofit,
            'topcategory' => $topcategory,
            'alltrans' => $alltrans
        ]);
        return view('admin.index');
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user', [
            'title' => "User Data",
            'items' => $users
        ]);
    }

    public function jasa()
    {
        $jasa = Jasa::select('*')->orderBy('jasa_status')->get();
        return view('admin.jasa', [
            'title' => "Jasa Data",
            'items' => $jasa
        ]);
    }

    public function request()
    {
        $request = RequestBuyer::select('*')->orderBy('request_status')->get();
        return view('admin.request', [
            'title' => "Request Data",
            'items' => $request
        ]);
    }

    public function actionuser($id)
    {
        return redirect('/admin/user');
    }

    public function actionjasa($id, $action)
    {
        if ($action == 1) {
            Jasa::where('jasa_id', $id)->update(['jasa_status' => 1]);
        }elseif ($action == -1){
            Jasa::where('jasa_id', $id)->update(['jasa_status' => 2]);
        }
        return redirect('/admin/jasa');
    }

    public function actionrequest($id, $action)
    {
        if ($action == 1) {
            RequestBuyer::where('request_id', $id)->update(['request_status' => 1]);
        }elseif ($action == -1){
            RequestBuyer::where('request_id', $id)->update(['request_status' => 3]);
        }
        return redirect('/admin/request');
    }

    public function getdatadashboard()
    {
        $counttranseachmonth = Transaksi::selectRaw('count(*) as jumlah')->whereRaw("year(created_at) = '2020'")->groupByRaw(' month(created_at)')->get();
        $monthtranseachmonth = Transaksi::selectRaw('month(created_at) as bulan')->whereRaw("year(created_at) = '2020'")->groupByRaw(' month(created_at)')->get();
        $countjasaeachmonth = Jasa::selectRaw('count(*) as jumlah')->whereRaw("year(jasa_publish_date) = '2020' AND jasa_status = 1")->groupByRaw(' month(jasa_publish_date)')->get();
        $monthjasaeachmonth = Jasa::selectRaw('month(jasa_publish_date) as bulan')->whereRaw("year(jasa_publish_date) = '2020' AND jasa_status = 1")->groupByRaw(' month(jasa_publish_date)')->get();
        $countusereachmonth = User::selectRaw('count(*) as jumlah')->whereRaw("year(date_created) = '2020'")->groupByRaw(' month(date_created)')->get();
        $monthusereachmonth = User::selectRaw('month(date_created) as bulan')->whereRaw("year(date_created) = '2020'")->groupByRaw(' month(date_created)')->get();
        $countprofiteachmonth = Transaksi::selectRaw('sum(transaksi_price) as jumlah')->whereRaw("year(created_at) = '2020'")->groupByRaw(' month(created_at)')->get();
        $monthprofiteachmonth = Transaksi::selectRaw('month(created_at) as bulan')->whereRaw("year(created_at) = '2020'")->groupByRaw(' month(created_at)')->get();
        return [
            'countusereachmonth' => $countusereachmonth,
            'monthusereachmonth' => $monthusereachmonth,
            'counttranseachmonth' => $counttranseachmonth,
            'monthtranseachmonth' => $monthtranseachmonth,
            'countjasaeachmonth' => $countjasaeachmonth,
            'monthjasaeachmonth' => $monthjasaeachmonth,
            'countprofiteachmonth' => $countprofiteachmonth,
            'monthprofiteachmonth' => $monthprofiteachmonth
        ];
    }

    public function gettrans(Request $request)
    {
        $ret = Transaksi::whereRaw('created_at > '.$request->datestart.' AND created_at < '.$request->dateend)->get();
        return $ret;
    }
}
