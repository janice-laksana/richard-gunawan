<?php

namespace App\Http\Controllers\User\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\RequestBuyer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    //
    public function index()
    {
        $data['requestPending'] = RequestBuyer::where('user_id', Auth::id())->where('request_status', 0)->get();
        $data['requestActive'] = RequestBuyer::where('user_id', Auth::id())->where('request_status', 1)->get();

        return view('user.buyer.request.index', $data);
    }

    public function create()
    {
        $data['list_category'] = Category::all();
        // dd($data);
        return view('user.buyer.request.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'jasa_time' => 'required',
            'budget' => 'required|numeric',
        ]);

        $data = [
            'request_description' => $request->description,
            'category_id' => $request->category_id,
            'jasa_time' => $request->jasa_time,
            'request_budget' => $request->budget,
            'user_id' => Auth::id(),
        ];

        $requestbuyer = RequestBuyer::create($data);

        if($requestbuyer) {
            return redirect('buyer/request')->withSuccess('Request successfully created');
        } else {
            return back();
        }

    }

    public function show(Request $request)
    {
        $requestbuyer = RequestBuyer::where('request_id', $request->id)->first();
        $data['request'] = $requestbuyer;

        $list_status = [
            'Pending',
            'Active',
        ];
        $data['list_status'] = $list_status;

        $data['list_offer'] = $requestbuyer->offer;
        return view('user.buyer.request.show', $data);
    }

    public function order(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        $requestbuyer = RequestBuyer::find($request->request_id);

        $jasa = $offer->jasa;

        $data['offer'] = $offer;
        $data['request'] = $requestbuyer;
        $data['jasa'] = $jasa;

        return view('user.buyer.transaction.checkout', $data);

    }

    public function destroy(Request $request)
    {
        Offer::where('offer_id',$request->offer_id)->delete();
    }

}
