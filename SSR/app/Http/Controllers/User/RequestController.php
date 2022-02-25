<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jasa;
use App\Models\Offer;
use App\Models\RequestBuyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    //
    public function index()
    {
        $data['list_category'] = Category::all();

        $list_request_id = Offer::where('user_id', Auth::id())->pluck('request_id');
        $data['list_request'] = RequestBuyer::where('user_id','!=',Auth::id())->where('request_status', 1)->whereNotIn('request_id', $list_request_id)->get();
        // dd($data);

        return view('user.request.index', $data);
    }

    public function loadData(Request $request)
    {
        $id_cat = $request->id_cat;

        $list_request_id = Offer::where('user_id', Auth::id())->pluck('request_id');
        $list_request = RequestBuyer::where('user_id','!=',Auth::id())->where('request_status', 1)->whereNotIn('request_id', $list_request_id)->where('category_id', $id_cat)->get();

        $data = [
            'list_request' => $list_request,
        ];

        return view('user.request.ajax', $data);

    }

    public function show(Request $request)
    {
        $requestbuyer = RequestBuyer::where('request_id', $request->id)->first();
        $data['request'] = $requestbuyer;

        $data['list_jasa'] = Jasa::where('user_id', Auth::id())->get();

        return view('user.request.show', $data);
    }

    public function store(Request $request)
    {
        $request_id = $request->id;
        $request->validate([
            'jasa_id' => 'required',
            'price' => 'required|numeric',
            'time' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'offer_message' => $request->description,
            'offer_price' => $request->price,
            'request_id' => $request_id,
            'jasa_id' => $request->jasa_id,
            'user_id' => Auth::id(),
        ];

        $offer = Offer::create($data);

        if($offer) {
            return redirect('request')->withSuccess('Offer successfully created');
        } else {
            return back();
        }

    }

}
