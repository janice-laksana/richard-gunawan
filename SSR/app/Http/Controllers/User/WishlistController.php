<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $wishlist = Jasa::with('wishlist')->where('user_id',Auth::user()->id)->get();
        $wishlist = DB::select('select * from wishlist w
            join jasa j on j.jasa_id = w.wishlist_id_jasa
            where wishlist_id_user = ?'
        , [Auth::user()->id]);

        return view('user.profile.wishlist.index',['wishlist'=>$wishlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($iduser,$idjasa)
    {
        $wish = Wishlist::where([
            ['wishlist_id_user',$iduser],
            ['wishlist_id_jasa',$idjasa]
        ])->get();

        if(count($wish)<=0){ //jika tidak ada jasa diwishlist
            $wish = new Wishlist();
            $wish->wishlist_id_jasa = $idjasa;
            $wish->wishlist_id_user = $iduser;
            $wish->save();
            $message = 'success';
        } else { //jika ada, didelete
            $wish[0]->delete();
            $message = 'danger';
        }
        return back()->with($message,'Masuk');
        // return dd($_GET["dariAjax"]);
        // return redirect('/wishlist/',['status'=>"halo"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxMyWish(Request $request)
    {
        $orderby = $request->sortBy;
        $ascDesc = $request->ascDesc;

        $wishlist = DB::select('select * from wishlist w
            join jasa j on j.jasa_id = w.wishlist_id_jasa
            where wishlist_id_user = ?
            order by j.'.$orderby .' '. $ascDesc
        , [Auth::user()->id]);

        return view('user.profile.wishlist.ajax',['wishlist'=>$wishlist]);
    }
}
