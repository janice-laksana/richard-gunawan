@extends('layouts.user.app')

@section('content')
<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
      <div class="solid_banner_inner">
        <h3>Checkout</h3>
        <h6>Isi semua informasi di bawah ini</h6>
        <hr>
        <h5>
          <i class="icon-arrow-left"></i>
          <a href="{{ isset($offer) ? url('buyer/request/') . '/' . $offer->request_id : url('seller/jasa/show/') . '/' . $jasa->jasa_id }}"><span class="text-dark">Back</span></a>
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
              <h2 class="reg_title">Detail Billing</h2>
              <form class="billing_inner row" method="POST" action="{{ url('buyer/transaction/add') }}">
                <input type="hidden" name="jasa_id" value="{{ $jasa->jasa_id }}">
                @csrf
                @if (isset($offer))
                    <input type="hidden" name="offer_id" value="{{ $offer->offer_id }}">
                    <input type="hidden" name="request_id" value="{{ $request->request_id }}">
                @endif

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="order">Catatan Pesanan  <span>*</span></label>
                    <textarea minlength="10" required class="form-control" name="notes" id="notes" rows="3"></textarea>
                  </div>

                </div>

            </div>
          </div>
          <div class="col-lg-5">
            <div class="order_box_price">
              <h2 class="reg_title">Pesanan Anda</h2>
              <div class="payment_list">
                <div class="row justify-content-center text-center">
                    @if (strpos($jasa->jasa_img, '://') == false)
                    <img class="img-fluid" src="{{ asset('storage/img/jasa/') . '/' . $jasa->jasa_img }}" alt="">
                    @else
                    <img class="img-fluid" src="{{$jasa->jasa_img}}" alt="">
                    @endif

                </div>


                <h4 class="font-weight-bold text-center">{{ $jasa->jasa_name }}</h4>
                <h6 class="text-center text-muted">By : {{ $jasa->user->name }}</h6>
                <div class="price_single_cost">
                    @if (isset($offer))
                        <h5>{{ $offer->offer_message }}</h5>
                    @endif
                    <ul class="">
                        <li>Detail Jasa</li>
                    </ul>
                    @if (isset($offer))
                    <h4>Subtotal Cart <span>Rp. {{ number_format($offer->offer_price) }}</span></h4>
                    <h3><span class="normal_text">Total Pesanan</span> <span>Rp. {{ number_format($offer->offer_price) }}</span></h3>
                    @else
                    <h4>Subtotal Cart <span>Rp. {{ number_format($jasa->jasa_price) }}</span></h4>
                    <h3><span class="normal_text">Total Pesanan</span> <span>Rp. {{ number_format($jasa->jasa_price) }}</span></h3>
                    @endif
                </div>
                <div id="accordion" role="tablist" class="price_method" required>
                  <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                      <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                        Gunakan saldo E-wallet
                        </a>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        Semua transaksi terjamin dan diawasi.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" value="submit" class="btn subs_btn form-control">Kirim Pesanan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!--================End Register Area =================-->


@endsection
