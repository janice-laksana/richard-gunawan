<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jasa;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jasaAktif = Jasa::where([
            ['user_id',Auth::user()->id],
            ['jasa_status',1]
        ])->get();

        $jasaPending = Jasa::where([
            ['user_id',Auth::user()->id],
            ['jasa_status',0]
        ])->get();

        $jasaCancel = Jasa::where([
            ['user_id',Auth::user()->id],
            ['jasa_status',2]
        ])->get();
        $category = Category::all();
        return view('user.seller.jasa.index',['jasaAktif'=>$jasaAktif,'jasaPending'=>$jasaPending,'jasaCancel'=>$jasaCancel,'category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($action)
    {
        switch ($action) {
            case 0:
                $category = Category::all();
                return view('user.seller.jasa.create.dashboard',['category'=>$category]);
                break;
            case 1:
                return view('user.seller.jasa.create.pricing',[]);
                break;
            case 2:
                return view('user.seller.jasa.create.desc',[]);
                break;
            case 3:
                $createJasa = Cookie::get('createJasa');
                $createJasa = json_decode($createJasa);
                return view('user.seller.jasa.create.gallery',['data'=>$createJasa]);
                break;
            default:
                break;
        };
    }

    public function saveCookie(Request $request, $createJasa)
    {
        $temp = $request->except('_token');
        array_push($createJasa,$temp);
        Cookie::queue('createJasa',json_encode($createJasa));
        return $createJasa;
    }

    public function doCreate(Request $request, $action)
    {
        $createJasa = Cookie::get('createJasa');
        if ($createJasa != null) {
            $createJasa = json_decode($createJasa);
        } else {
            $createJasa = [];
        }

        switch ($action) {
            case 0:
                $request->validate([
                    'jasa_name' => 'required|min:15'
                ]);
                $createJasa = $this->saveCookie($request,$createJasa);
                return redirect()->route('jasaCreate', ['action' => 1]);
                break;
            case 1:
                $request->validate([
                    'jasa_price' => 'numeric',
                    'jasa_descPrice' => 'required|min:50',
                    'jasa_days' => 'numeric',
                ]);
                $createJasa = $this->saveCookie($request,$createJasa);
                return redirect()->route('jasaCreate', ['action' => 2]);
                break;
            case 2:
                $request->validate([
                    'jasa_desc' => 'required|min:50',
                    'jasa_req' => 'required|min:50',
                ]);
                $createJasa = $this->saveCookie($request,$createJasa);
                //return response()->json($createJasa);
                return redirect()->route('jasaCreate', ['action' => 3]);
                break;
            default:
                break;
        };
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
            // 'image' => 'required|image|dimensions:min_width=100,min_height=200'
            // 'image' => 'required|image|dimensions:ratio=3/2'
        ]);
        //Upload Image
        if($request->hasFile('image')){
            $oriName = $request->file('image')->getClientOriginalName();
            $noExt = pathinfo($oriName,PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName= $request->user_id.'.'.$noExt.'.'.time().'.'.$ext;

            $request->file('image')->storeAs('public/img/jasa',$fileName);
        }
        $request->request->set('jasa_img',$fileName);
        //Insert Jasa
        Jasa::create($request->except('_token','image'));
        //Delete Cookie
        return redirect()->route('jasaIndex')->withCookie(Cookie::forget('createJasa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jasa = Jasa::with('category')->find($id);
        $wish = Wishlist::where([
            ['wishlist_id_user',Auth::user()->id],
            ['wishlist_id_jasa',$id]
        ])->get();
        $find_rec = DB::table('recommend')->where([
            ['recommend_id_kate','=',$jasa->category->category_id],
            ['recommend_id_user','=',Auth::user()->id]
        ])->get();
        if (count($find_rec) > 0) {
            DB::table('recommend')->where([
                ['recommend_id_kate','=',$jasa->category->category_id],
                ['recommend_id_user','=',Auth::user()->id]
            ])->update(['recommend_jumlah' => $find_rec[0]->recommend_jumlah+1]);
        }else{
            DB::table('recommend')->insert([
                'recommend_id_kate' => $jasa->category->category_id,
                'recommend_id_user' => Auth::user()->id,
                'recommend_jumlah' => 1
            ]);
        }
        $transaksi = Transaksi::where('transaksi_buyer_id', Auth::id())->get();
        return view('user.jasa.detail',['jasa'=>$jasa,'wish'=>count($wish),'transaksi'=>$transaksi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdate(Request $request)
    {
        $jasa = Jasa::find($request->idJasa);
        return $jasa;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jasa_name' => 'required|min:15',
            'jasa_price' => 'numeric',
            'jasa_descPrice' => 'required|min:50',
            'jasa_days' => 'numeric',
            'jasa_desc' => 'required|min:50',
            'jasa_req' => 'required|min:50',
            'jasa_req' => 'required|min:50',
            // 'image' => 'required|image'
        ]);

        $jasa = Jasa::find($id);
        $jasa->jasa_name = $request->jasa_name;
        $jasa->kat_skill_id = $request->kat_skill_id;
        $jasa->jasa_price = $request->jasa_price;
        $jasa->jasa_descPrice = $request->jasa_descPrice;
        $jasa->jasa_days = $request->jasa_days;
        $jasa->jasa_desc = $request->jasa_desc;
        $jasa->jasa_req = $request->jasa_req;
        $jasa->save();

        return redirect()->route('jasaIndex')->with('success','The '.$request->jasa_name.' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    public function ajaxCancel(Request $request)
    {
        $id = $request->id;
        $jasa = Jasa::find($id);
        $jasa->jasa_status=2;
        $jasa->save();
    }

    public function ajaxMyJasa(Request $request)
    {
        $jasa = Jasa::where(['jasa_status'=>$request->status,'user_id'=>$request->user_id])->orderBy($request->sortBy, $request->ascDesc)->get();
        return view('user.seller.jasa.ajax',['jasa'=>$jasa]);
    }

    public function saveSearch(Request $request,$search)
    {
        $request->session()->put('searchBar',$search);
        return redirect('/jasa/1');
    }

    public function clearSearch(Request $request)
    {
        $request->session()->forget('searchBar');
        return back();
    }

    public function indexPublic(Request $request,$id)
    {
        if($request->session()->get('searchBar') !=null){
            $search = $request->session()->get('searchBar');

            $jasa = DB::table('jasa')
            ->where('user_id','!=',Auth::id())
            ->where('jasa_status',1)
            ->where('kat_skill_id',$id)
            ->where('jasa_name','LIKE','%'.$search.'%')
            ->join('users', 'users.id', '=', 'jasa.user_id')
            ->paginate(3);
        } else {
            $jasa = DB::table('jasa')
            ->where('user_id','!=',Auth::id())
            ->where('jasa_status',1)
            ->where('kat_skill_id',$id)
            ->join('users', 'users.id', '=', 'jasa.user_id')
            ->paginate(3);
        }
        $category = Category::all();
        $wish = Wishlist::where([['wishlist_id_user',Auth::user()->id]])->get();

        // {{ $jasa->links() }}
        return view('user.jasa.index',['jasas'=>$jasa,'category'=>$category,'wish'=>$wish,'request'=>$request]);
    }

    public function ajaxIndexPublic(Request $request)
    {
        $orderby = $request->sortBy;
        $ascDesc = $request->ascDesc;
        $id_cat = $request->id_cat;

        $jasas =
        DB::table('jasa')
        ->where('user_id','!=',Auth::id())
        ->where('jasa_status',1)
        ->where('kat_skill_id',$id_cat)
        ->join('users', 'users.id', '=', 'jasa.user_id')
        ->orderBy($orderby,$ascDesc)
        ->get();

        $category = Category::all();
        $wish = Wishlist::where([
            ['wishlist_id_user',Auth::user()->id]])->get();

        return view('user.jasa.ajax',['jasas'=>$jasas,'category'=>$category,'wish'=>$wish]);
    }

    public function addReview(Request $request)
    {
        $jasa_id = $request->id;

        $th_beli = Transaksi::where([
            'transaksi_buyer_id' => Auth::id(),
            'transaksi_status' => 2,
            'jasa_id' => $jasa_id,
        ])->orderBy('created_at','desc')->first();

        if($th_beli == null) {
            return back()->with('fail-review','Review not created!');
        }

        $review = Review::where([
            'transaksi_id' => $th_beli->transaksi_id,
            'user_id' => Auth::id(),
        ])->first();

        if($review != null) {
            return back()->with('fail-review','Review not created!');
        }

        $data = [
            'review_star' => $request->star,
            'review_message' => $request->review,
            'jasa_id' => $jasa_id,
            'user_id' => Auth::id(),
            'transaksi_id' => $th_beli->transaksi_id,
        ];

        $review = Review::create($data);

        if($review) {
            $jasa = Jasa::find($jasa_id);
            $averagereview = $jasa->review->avg('review_star');
            $jasa->jasa_rating = $averagereview;
            $jasa->save();
        }

        return back()->with('success-review','Review created!');

    }

    public function order(Request $request)
    {
        $jasa = Jasa::find($request->jasa_id);

        // $data['offer'] = $offer;
        // $data['request'] = $requestbuyer;
        $data['jasa'] = $jasa;

        return view('user.buyer.transaction.checkout', $data);

    }

}
