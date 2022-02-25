@extends('layouts.user.app')

@section('search')
    <div class="top_header_left">
        <form id="enterSearch">
        <div class="input-group">
            @if ($request->session()->get('searchBar') !=null)
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" id="searchBar" onkeypress="" value="{{$request->session()->get('searchBar')}}">
            @else
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" id="searchBar" onkeypress="">
            @endif
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button" onclick="goSearch()"><i class="icon-magnifier"></i></button>
            </span>
        </div>
        <a href="{{url('clearSearch')}}"><caption>Clear Search</caption></a>
        </form>
    </div>
@endsection

@section('content')
<section class="categories_product_main p_80">
    <div class="container">
        <div class="categories_main_inner">
            <div class="row row_disable">
                <div class="col-lg-9 float-md-right">
                    <div class="showing_fillter">
                        <div class="row m0">
                            <div class="first_fillter" id="showingString">
                                <h4>Showing {{$jasas->count()}} of {{$jasas->total()}} total</h4>
                            </div>
                            <div class="secand_fillter">
                                <h4>SORT BY :</h4>
                                <select class="selectpicker" id="filterSortBy" onchange="refreshItems(1)">
                                    <option value="jasa_rating">Rating</option>
                                    <option value="jasa_name">Name</option>
                                    <option value="jasa_price">Price</option>
                                </select>
                            </div>
                            <input type="hidden" name="sortBy" id="sortBy" value="">
                            <input type="hidden" name="ascDesc" id="ascDesc" value="">
                            <input type="hidden" name="id_cat" id="id_cat" value="">
                            <div class="third_fillter">
                                <h4>By: </h4>
                                <select class="selectpicker"  id="filterAscDesc" onchange="refreshItems(1)" >
                                    <option value="desc">DESC</option>  
                                    <option value="asc">ASC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="c_product_grid_details" id="divItems">
                        @forelse ($jasas as $jasa)
                            <div class="c_product_item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="c_product_img">
                                            {{-- <img class="img-fluid" src="/storage/img/jasa/{{$jasa->jasa_img}}" alt=""> --}}
                                            @if (strpos($jasa->jasa_img, '://') == false)
                                                <img src="/storage/img/jasa/{{$jasa->jasa_img}}"  alt=""  class="img-fluid">
                                            @else 
                                                <img class="img-fluid" src="{{$jasa->jasa_img}}" alt="">                                    
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <div class="c_product_text">
                                            <h3>{{$jasa->jasa_name}}</h3>
                                            <h5>Rp. <?php echo number_format($jasa->jasa_price, 0, '.', ',');  ?>,-</h5>
                                            <ul class="product_rating">
                                                @for ($i = 0; $i < intval($jasa->jasa_rating); $i++)
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                @endfor
                                                @for ($i = 0; $i < (5 - intval($jasa->jasa_rating)); $i++)
                                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                @endfor
                                            </ul>
                                            <h6 style="color:blue">{{$jasa->name}}</h6>                                        
                                            <p>{{ \Illuminate\Support\Str::limit($jasa->jasa_desc, 150, $end='...') }}</p>
                                            <ul class="c_product_btn">
                                                <li><a class="add_cart_btn" href="{{url('seller/jasa/show/'.$jasa->jasa_id)}}">Details</a></li>
                                                @if (Auth::user()->id != $jasa->user_id)
                                                    <li class="p_icon">
                                                        <a href="{{url('/wishlist'.'/'. Auth::user()->id.'/'. $jasa->jasa_id)}}" style="margin-top: 6px;">
                                                            @php
                                                                $ada = false;
                                                                for ($i=0; $i < count($wish); $i++) { 
                                                                    if ($wish[$i]->wishlist_id_jasa == $jasa->jasa_id){
                                                                        $ada = true;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($ada)
                                                                <i class="icon_heart"></i>
                                                            @else
                                                                <i class="icon_heart_alt"></i>
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h1>TIdak ada jasa sementara ini</h1>
                        @endforelse
                        <nav aria-label="Page navigation example" class="pagination_area">
                          <ul class="pagination">
                            {{ $jasas->links() }}
                          </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 float-md-right">
                    <div class="categories_sidebar">
                        <aside class="l_widgest l_p_categories_widget">
                            <div class="l_w_title">
                                <h3>Categories</h3> 
                            </div>
                            <ul class="navbar-nav">
                                @forelse ($category as $c)
                                    <input type="hidden" name="currIDCat" id="currIDCat" value="{{$c->category_id}}">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('/jasa/'.$c->category_id)}}">{{$c->category_name}}</a>
                                        {{-- <a class="nav-link" href="#" onclick="refreshItems({{$c->category_id}})">{{$c->category_name}}</a> --}}
                                    </li>
                                @empty
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"> Tidak ada kategori saat ini
                                        <i class="icon_minus-06" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforelse
                                
                            </ul>
                        </aside>
                        {{-- <aside class="l_widgest l_fillter_widget">
                            <div class="l_w_title">
                                <h3>Filter section</h3>
                            </div>
                        </aside>
                        <div class="quantity">
                            <label for="from_price">Greater Than </label><br>
                            <div class="custom">                                
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value=parseInt(result.value)-10000;changeFilter();return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                <input type="text" id="sst" maxlength="12" value="10000" title="Quantity:" class="input-text qty" name="from_price" value="{{old('jasa_price')}}">
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value=parseInt(result.value)+10000;changeFilter();return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                            </div>
                        </div>
                        <div class="quantity">
                            <label for="to_price">Less Than</label><br>
                                <div class="quantity" style="margin-top: 0">
                                    <div class="custom">
                                        <button onclick="var result = document.getElementById('sst2'); var sst2 = result.value; if( !isNaN( sst2 ) &amp;&amp; sst2 > 0 ) result.value=parseInt(result.value)-10000;changeFilter();return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                        <input type="text" id="sst2" maxlength="12" value="1000000" title="Quantity:" class="input-text qty" name="to_price" value="{{old('jasa_days')}}" >
                                        <button onclick="var greater = document.getElementById('sst'); result = document.getElementById('sst2'); var sst2 = result.value; if( !isNaN( sst2 ) &amp;&amp; sst2 > greater) result.value=parseInt(result.value)+10000;changeFilter();return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                    </div>
                                </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
<script>
    function refreshItems(id_cat1) {
        var sortBy = $("#filterSortBy").val();
        var ascDesc = $("#filterAscDesc").val();
        var temp = window.location.pathname;

        $.ajax({
            "method": "get",
            "url": '/jasa/ajax',
            "data": {
                "_token": "{{csrf_token()}}",
                sortBy : sortBy,
                ascDesc : ascDesc,
                id_cat : temp.substr(-1)
            },
            "success": function(data) {
                // alert(data);
                // console.log(data);
                $("#divItems").html(data);
            },
            "error": function(error) {
                alert('error');
                console.log(error);
            }
        });
    }

        function actionWishlist() {
            var pageURL = $(location).attr("pathname");
            var jasa_id = $("#jasa_id").val();
            var user_id = $("#user_id").val();
            $.ajax({
                "method": "get",
                "url": '/wishlist/'+user_id+'/'+jasa_id,
                "data": {
                    // "_token": "{{csrf_token()}}",
                    dariAjax : "test",
                    jasa_id : jasa_id,
                    user_id : user_id
                },
                "success": function(data) {
                    // console.log(data["status"]);
                    if(data["status"] == "remove"){
                        $("#iconWishlist").removeClass("icon_heart");
                        $("#iconWishlist").addClass("icon_heart_alt");
                    } else {
                        $("#iconWishlist").removeClass("icon_heart_alt");
                        $("#iconWishlist").addClass("icon_heart");
                    }
                },
                "error": function(error) {
                    alert(JSON.stringify(error));
                    console.log(error);
                }
            });
        }

        function changeFilter(){
            var greater = $("#sst").val();
            var lesser = $("#sst2").val();
        }
</script>
@endsection
