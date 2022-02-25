<?php

namespace App\Http\Controllers\User\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Offer;
use App\Models\RequestBuyer;
use App\Models\Transaksi;
use App\Notifications\SellerTransactionNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    //
    public function index()
    {
        $data['transaksiPending'] = Transaksi::where('transaksi_buyer_id', Auth::id())->where('transaksi_status', 0)->get();
        $data['transaksiActive'] = Transaksi::where('transaksi_buyer_id', Auth::id())->where('transaksi_status', 1)->get();
        $data['transaksiFinished'] = Transaksi::where('transaksi_buyer_id', Auth::id())->where('transaksi_status', 2)->get();

        return view('user.buyer.transaction.index', $data);
    }

    public function store(Request $request)
    {
        $jasa = Jasa::find($request->jasa_id);

        if($request->offer_id != null) {
            // dd($request->all());
            $offer = Offer::find($request->offer_id);
            $requestbuyer = RequestBuyer::find($request->request_id);
        }

        $generated_id = date('Ymd') . '_' . Str::random(10);

        $data = [
            'transaksi_id' => $generated_id,
            'jasa_id' => $request->jasa_id,
            'transaksi_seller_id' => $jasa->user_id,
            'transaksi_buyer_id' => Auth::id(),
            'transaksi_status' => 0,
            'transaksi_delivery_time' => $jasa->jasa_days,
            'transaksi_notes' => $request->notes,
        ];
        $seller = User::find($jasa->user_id);
        DB::beginTransaction();
        if($request->offer_id != null) {
            $price = $offer->offer_price;
            $data['transaksi_price'] = $price;

            // cek dulu apakah user pembeli memiliki cukup uang
            $transaksi = null;
            if(Auth::user()->user_balance >= $price) {
                $id = Auth::user()->id;
                $user = User::find($id);
                $user->decrement('user_balance', $price);

                $transaksi = Transaksi::create($data);
            }

            if($transaksi) {
                $offer->delete();
                $requestbuyer->delete();
                $seller->notify(new SellerTransactionNotification());
                DB::commit();
                return redirect('buyer/transaction')->withSuccess('Berhasil');
            } else {
                DB::rollback();
                return back()->withFail('Gagal, saldo tidak cukup');
            }

        } else {
            // lakukan notificaiton

            $price = $jasa->jasa_price;
            $data['transaksi_price'] = $price;

            // cek dulu apakah user pembeli memiliki cukup uang
            $transaksi = null;
            if(Auth::user()->user_balance >= $price) {
                $id = Auth::user()->id;
                $user = User::find($id);
                $user->decrement('user_balance', $price);

                $transaksi = Transaksi::create($data);
            }

            if($transaksi) {
                $seller->notify(new SellerTransactionNotification());
                DB::commit();
                return redirect('buyer/transaction')->withSuccess('Berhasil');
            } else {
                DB::rollback();
                return back()->withFail('Gagal, saldo tidak cukup');
            }

        }


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

        return view('user.buyer.transaction.show', $data);
    }

}
