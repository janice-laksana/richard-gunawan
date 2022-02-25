@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">Your Custom Request</h2>
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
            <a class="shop_now_btn" href="{{ url('buyer/request/add') }}">Create new Request</a>
            <nav class="tab_menu">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-active-tab" data-toggle="tab" href="#nav-active" role="tab" aria-controls="nav-active" aria-selected="true">Aktif <span class="badge badge-primary"><?= count($requestActive) > 0 ? count($requestActive) : '' ?></span></a>
                <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">Pending <span class="badge badge-warning"><?= count($requestPending) > 0 ? count($requestPending) : '' ?></span></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">

                <div class="items col-12 mt-4">
                    <div class="c_product_grid_details">
                    @foreach ($requestActive as $request)

                    <div class="c_product_item">
                        <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="c_product_text">
                            <h3>{{ $request->request_description }}</h3>
                            <h3>Category : <span class="font-weight-bold">{{ $request->category->category_name }}</span></h3>
                            <h6>Number of interest : <span>{{ $request->offer->count() }}</span></h6>
                            <ul class="c_product_btn mt-2">
                                <li><a class="add_cart_btn" href="{{ url('buyer/request/') . '/' . $request->request_id }}">Atur</a></li>
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
                        @foreach ($requestPending as $request)
                        <div class="c_product_item">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="c_product_text">
                                    <h3>{{ $request->request_description }}</h3>
                                    <h3>Category : <span class="font-weight-bold">{{ $request->category->category_name }}</span></h3>
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
