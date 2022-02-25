@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">My Wishlist</h2>
        </div>
        <div class="row justify-content-center">
          All the jasa you wish were yours!
        </div>
      </div>
    </div>

    <section class="no_sidebar_2column_area bg-white">
        <div class="container">
            <div class="showing_fillter">
                <div class="row m0">
                <div class="first_fillter">
                <h4>Showing <?= count($wishlist)?> jasa</h4>
            </div>
            <div class="four_fillter"> </div>
            <div class="secand_fillter">
                <h4>Sort :</h4>
                <select class="selectpicker" id="filterSortBy" onchange="refreshItems()">
                    <option value="jasa_name">Name</option>
                    <option value="jasa_price">Price</option>
                </select>
            </div>
            <div class="secand_fillter">
                <h4></h4>
                <select class="selectpicker" id="filterAscDesc" onchange="refreshItems()" style="width:100px;">
                    <option value="desc">Descending</option>
                    <option value="asc">Ascending</option>
                </select>
            </div>
                </div>
            </div>
            <div class="two_column_product">
                <div class="row" id="divItems">
                    @forelse ($wishlist as $w)
                        <div class="col-lg-4 col-sm-6">
                            <div class="l_product_item">
                                <div class="l_p_img">
                                    @if (strpos($w->jasa_img, '://') == false)
                                        <img src="/storage/img/jasa/{{$w->jasa_img}}"  alt=""  class="img-fluid">
                                    @else 
                                        <img class="img-fluid" src="{{$w->jasa_img}}" alt="">                                    
                                    @endif
                                </div>
                            <div class="l_p_text">
                                    <ul>
                                        <li>
                                            {{-- <a class="add_cart_btn" href="{{url('seller/jasa/show/'.$w->jasa_id)}}">Details</a> --}}
                                            <a class="add_cart_btn" href="{{url('seller/jasa/show/'.$w->jasa_id)}}">Details</a>
                                        </li>
                                        <li class="p_icon" >
                                            <a href="{{url('/wishlist'.'/'. Auth::user()->id.'/'. $w->jasa_id)}}">
                                                <i id="iconWishlist" class="icon_heart"></i>
                                                <input type="hidden" name="user_id" id="user_id"  value="{{Auth::user()->id}}">
                                                <input type="hidden" name="jasa_id" id="jasa_id" value="{{$w->jasa_id}}">
                                            </a>
                                        </li>
                                    </ul>
                                    <h4>{{$w->jasa_name}}</h4> 
                                    <h5>Rp. <?= number_format($w->jasa_price) ?> ,-</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12" style="text-align: center"><h3>Your Wishlist is Empty! Browse <a href="">here</a> to search for jasas!</h3></div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script>
        function refreshItems() {
            var sortBy = $("#filterSortBy").val();
            var ascDesc = $("#filterAscDesc").val();

            $.ajax({
                "method": "post",
                "url": '/wishlist/ajaxMyWish',
                "data": {
                    "_token": "{{csrf_token()}}",
                    sortBy : sortBy,
                    ascDesc : ascDesc
                },
                "success": function(data) {
                    // alert(data);
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
                "url": pageURL+'/'+user_id+'/'+jasa_id,
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
    </script>
@endsection