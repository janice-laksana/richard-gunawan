@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">Your Custom Offer</h2>
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
            {{-- <a class="shop_now_btn" href="{{ url('seller/offer/add') }}">Create new Offer</a> --}}
            <nav class="tab_menu">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">Pending <span class="badge badge-warning"><?= count($offerPending) > 0 ? count($offerPending) : '' ?></span></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                <div class="items col-12 mt-4">
                    <div class="c_product_grid_details">
                        @foreach ($offerPending as $offer)
                        <div class="c_product_item">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="c_product_text">
                                    <h4>Requester : {{ $offer->request->user->name }}</h4>
                                    <h3>{{ $offer->offer_message }}</h3>
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
