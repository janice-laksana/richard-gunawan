<?php

namespace App\Http\Controllers\User\Seller;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    //
    public function index()
    {
        $data['transaksiPending'] = Transaksi::where('transaksi_seller_id', Auth::id())->where('transaksi_status', 0)->get();
        $data['transaksiActive'] = Transaksi::where('transaksi_seller_id', Auth::id())->where('transaksi_status', 1)->get();
        $data['transaksiFinished'] = Transaksi::where('transaksi_seller_id', Auth::id())->where('transaksi_status', 2)->get();
        // dd($data);
        return view('user.seller.transaction.index', $data);
    }

    public function accept(Request $request)
    {
        $id = $request->id;
        Transaksi::find($id)->update([
            'transaksi_status' => 1,
            'started_at' => Carbon::now(),
        ]);
        return redirect('seller/transaction')->withSuccess('Success accept');
    }

    public function decline(Request $request)
    {
        $id = $request->id;
        Transaksi::find($id)->update([
            'transaksi_status' => 3,
        ]);
        return redirect('seller/transaction')->withSuccess('Success decline');
    }

    public function finish(Request $request)
    {
        $id = $request->id;

        $transaksi = Transaksi::find($id);

        $transaksi->update([
            'transaksi_status' => 2,
            'finished_at' => Carbon::now(),
        ]);

        $buyer = $transaksi->buyer;
        $seller = $transaksi->seller;

        // ketika finish hanya seller nya yang ditambah uang nya
        // $buyer->decrement('user_balance', $transaksi->transaksi_price);
        $seller->increment('user_balance', $transaksi->transaksi_price);

        return back()->withSuccess('Success finish');
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $transaksi = Transaksi::find($id);
        $data['transaksi'] = $transaksi;
        $data['jasa'] = $transaksi->jasa;

        $list_status = [
            'Pending',
            'Active',
            'Finished',
            'Canceled',
        ];
        $data['list_status'] = $list_status;

        return view('user.seller.transaction.show', $data);
    }


}
