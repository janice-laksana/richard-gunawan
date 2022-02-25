<?php

namespace App\Http\Controllers\User\Seller;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\RequestBuyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    //
    public function index()
    {
        $data['offerPending'] = Offer::where('user_id', Auth::id())->where('offer_status', 0)->get();

        return view('user.seller.offer.index', $data);
    }

    public function create()
    {
        $data['list_requestbuyer'] = RequestBuyer::all();
        // dd($data);
        return view('user.seller.offer.create', $data);
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

        $request = RequestBuyer::create($data);

        if($request) {
            return redirect('seller/request')->withSuccess('Request successfully created');
        } else {
            return back();
        }

    }

    public function show(Request $request)
    {
        $requestseller = RequestBuyer::where('request_id', $request->id)->first();
        $data['request'] = $requestseller;

        $list_status = [
            'Pending',
            'Active',
        ];
        $data['list_status'] = $list_status;

        $data['list_offer'] = $requestseller->offer;
        return view('user.seller.offer.show', $data);
    }

    public function order(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        $requestseller = RequestBuyer::find($request->request_id);

        $jasa = $offer->jasa;

        $data['offer'] = $offer;
        $data['request'] = $requestseller;
        $data['jasa'] = $jasa;

        return view('user.seller.transaction.checkout', $data);

    }

    public function destroy(Request $request)
    {
        Offer::where('offer_id',$request->offer_id)->delete();
    }
}
