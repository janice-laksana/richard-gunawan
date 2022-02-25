@extends('layouts.user.app')

@section('content')
<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
      <div class="solid_banner_inner">
        <h3>Detail Transaction</h3>
        <h6>Isi semua informasi di bawah ini</h6>
        <hr>
        <h5>
          <i class="icon-arrow-left"></i>
          <a href="{{ url('seller/transaction/') }}"><span class="text-dark">Back</span></a>
        </h5>
        <hr>
      </div>
    </div>
</section>
  <!--================End Categories Banner Area =================-->

<!--================Register Area =================-->
<section class="register_area p_100">
    <div class="container">
      <div class="register_inner">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing_details">
                    <h2 class="reg_title">Detail Transaksi </h2>
                    <h6>Transaksi ID : {{ $transaksi['transaksi_id'] }}</h6>

                    @if(Session::has('success'))
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif

                    <div class="billing_inner text-center mt-4">
                        <div class="col-lg-12">
                            <label for="delivery_time">Waktu Pengiriman </label>
                            <p class="mb-4 text-muted" id="delivery_time">{{ $transaksi['transaksi_delivery_time'] }} Days</p>
                            <hr>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-4">
                                    <label for="start">Mulai</label>
                                    @if ($transaksi->started_at !=  '')
                                    <p class="mb-4 text-muted" id="start">{{ date('d F Y', strtotime($transaksi->started_at)) }}</p>
                                    @else
                                    <p class="mb-4 text-muted" id="end">-</p>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <label for="end">Estimasi selesai</label>
                                    @if ($transaksi->started_at !=  '')
                                    <p class="mb-4 text-muted" id="end">{{ date('d F Y', (60 * 60 * 24 * $transaksi->transaksi_delivery_time) + strtotime($transaksi->started_at)) }}</p>
                                    @else
                                    <p class="mb-4 text-muted" id="end">-</p>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <label for="end">Selesai</label>
                                    @if ($transaksi->finished_at !=  '')
                                    <p class="mb-4 text-muted">{{ date('d F Y', strtotime($transaksi->finished_at)) }}</p>
                                    @else
                                    <p class="mb-4 text-muted">-</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
          <div class="col-lg-5">
            <div class="order_box_price">
              <h2 class="reg_title">Yang mengerjakan : {{ $transaksi->seller->name }}</h2>
              <h5>Status : <i>{{ $list_status[$transaksi->transaksi_status] }}</i></h5>
              <div class="payment_list">
                <div class="row justify-content-center text-center">
                    @if (strpos($jasa->jasa_img, '://') == false)
                    <img class="img-fluid" src="{{ asset('storage/img/jasa/') . '/' . $jasa->jasa_img }}" alt="">
                    @else
                    <img class="img-fluid" src="{{$jasa->jasa_img}}" alt="">
                    @endif
                </div>


                <h4 class="font-weight-bold text-center">{{ $jasa->jasa_name }}</h4>
                <div class="price_single_cost">
                @if (isset($offer))
                    <h5>{{ $offer->offer_message }}</h5>
                @endif
                  <ul class="">
                    <li>Transaction notes</li>
                    <li>
                        <p class="text-muted">{{ $transaksi->transaksi_notes }}</p>
                    </li>
                  </ul>
                  <h4>Subtotal Cart <span>Rp. {{ number_format($transaksi->transaksi_price) }}</span></h4>
                  <h3><span class="normal_text">Total Pesanan</span> <span>Rp. {{ number_format($transaksi->transaksi_price) }}</span></h3>
                </div>
              </div>
              @if ($transaksi->transaksi_status != 2)
              <a href="{{ url('seller/transaction/finish') . '/' .$transaksi->transaksi_id }}" class="btn subs_btn form-control">Finish Transaction</a>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!--================End Register Area =================-->


@endsection
