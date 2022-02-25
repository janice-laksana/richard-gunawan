@extends('layouts.user.app')

@section('content')
<!--================Categories Product Area =================-->
<section class="categories_product_main p_80">
    <div class="container">
      <div class="categories_main_inner">
        @if(Session::has('success'))
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
        <div class="row row_disable">
          <div class="col-lg-9 float-md-right">
            <div class="c_product_grid_details" id="container">
                @forelse ($list_request as $request)
                  <div class="c_product_item">
                    <div class="row">
                      <div class="col-12">
                        <div class="c_product_text">
                          <h4>Requester : {{ $request->user->name }}</h4>
                          <h5>Rp. {{ number_format($request->request_budget) }}</h5>
                          <!-- <h6>Available In <span>Stock</span></h6> -->
                          <p>{{ $request->request_description }}</p>
                          <ul class="c_product_btn">
                            <li><a class="add_cart_btn" href="{{ url('request/' . $request->request_id) }}">Berikan Tawaran</a></li>
                            {{-- <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li> --}}
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                <div class="row justify-content-center">
                  <p>TIDAK ADA DATA DITEMUKAN</p>
                </div>
                @endforelse
            </div>
          </div>
          <div class="col-lg-3 float-md-right">
            <div class="categories_sidebar">
              <aside class="l_widgest l_p_categories_widget">
                <div class="l_w_title">
                  <h3>Kategori</h3>
                </div>
                <ul class="navbar-nav" id="container">
                    @foreach ($list_category as $category)
                    <li class="nav-item justify-content-end">
                      <a onclick="changeCategory({{$category->category_id}})" class="nav-link" style="cursor: pointer;">
                        <span>{{ $category->category_name }}</span>
                        {{-- @if ($category->requestbuyer->count() > 0)
                        <span class="float-right badge badge-primary">{{ $category->requestbuyer->count() }}</span>
                        @endif --}}
                      </a>
                    </li>
                    @endforeach
                </ul>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!--================End Categories Product Area =================-->
@endsection

@section('customjs')
<script>
    function changeCategory(id_cat) {
      console.log(id_cat);
        $.ajax({
            "method": "get",
            "url": '/request/loadData',
            "data": {
                "_token": "{{csrf_token()}}",
                id_cat : id_cat
            },
            "success": function(data) {
                console.log(data);
                $("#container").html(data);
            },
            "error": function(error) {
                // alert('error');
                console.log(error);
            }
        });
    }
</script>
@endsection

