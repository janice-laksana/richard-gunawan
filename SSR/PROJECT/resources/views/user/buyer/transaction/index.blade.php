@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">Your Transaction</h2>
        </div>
        <div class="row justify-content-center">
          keterangan
        </div>
      </div>
    </div>

    <!--================Product Description Area =================-->
    <section class="product_description_area bg-white p_80">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-10">
            @if(Session::has('success'))
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            {{-- <a class="shop_now_btn" href="{{ url('buyer/transaksi/add') }}">Create new Request</a> --}}
            <nav class="tab_menu">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-active-tab" data-toggle="tab" href="#nav-active" role="tab" aria-controls="nav-active" aria-selected="true">Aktif <span class="badge badge-primary"><?= count($transaksiActive) > 0 ? count($transaksiActive) : '' ?></span></a>
                <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">Pending <span class="badge badge-warning"><?= count($transaksiPending) > 0 ? count($transaksiPending) : '' ?></span></a>
                <a class="nav-item nav-link" id="nav-finished-tab" data-toggle="tab" href="#nav-finished" role="tab" aria-controls="nav-finished" aria-selected="false">Finished <span class="badge badge-warning"><?= count($transaksiFinished) > 0 ? count($transaksiFinished) : '' ?></span></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">

                <div class="items col-12 mt-4">
                    <div class="c_product_grid_details">
                    @foreach ($transaksiActive as $transaksi)
                    <div class="c_product_item">
                        <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="c_product_text">
                                <h2>Transaction ID : {{ $transaksi->transaksi_id }}</h2>
                                <h3>{{ $transaksi->transaksi_description }}</h3>
                                <h3>Price : <span class="font-weight-bold">{{ number_format($transaksi->transaksi_price) }}</span></h3>
                                <ul class="c_product_btn mt-2">
                                    <li><a class="add_cart_btn" href="{{ url('buyer/transaction/') . '/' . $transaksi->transaksi_id }}">Atur</a></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach

                    </div>
                </div>

              </div>
              <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                <div class="items col-12 mt-4">
                    <div class="c_product_grid_details">
                        @foreach ($transaksiPending as $transaksi)
                        <div class="c_product_item">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="c_product_text">
                                        <h2>Transaction ID : {{ $transaksi->transaksi_id }}</h2>
                                        <h3>{{ $transaksi->transaksi_notes }}</h3>
                                        <h3>Price : <span class="font-weight-bold">{{ number_format($transaksi->transaksi_price) }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-finished" role="tabpanel" aria-labelledby="nav-finished-tab">
                <div class="items col-12 mt-4">
                    <div class="c_product_grid_details">
                        @foreach ($transaksiFinished as $transaksi)
                        <div class="c_product_item">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="c_product_text">
                                        <h2>Transaction ID : {{ $transaksi->transaksi_id }}</h2>
                                        <h3>{{ $transaksi->transaksi_notes }}</h3>

                                        Rate now : <a href="{{ url('seller/jasa/show') . '/' . $transaksi->jasa->jasa_id }}"><b>Detail jasa</b></a>

                                        {{-- <div class="card">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <a data-toggle="collapse" href="#collapse{{$transaksi->transaksi_id}}" role="button" aria-expanded="false" aria-controls="collapse{{$transaksi->transaksi_id}}">Related Jasa</a>
                                            </div>
                                            <div id="collapse{{$transaksi->transaksi_id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    {{ $transaksi->jasa->jasa_name }}
                                                </div>
                                            </div>
                                        </div> --}}

                                        <p>{{ $transaksi->transaksi_notes }}</p>
                                        <h3>Price : <span class="font-weight-bold">{{ number_format($transaksi->transaksi_price) }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Details Area =================-->

  </div>
  <script>
    // $(document).ready(() => {
    //     $('.items').hide();
    // });
  </script>

@endsection
