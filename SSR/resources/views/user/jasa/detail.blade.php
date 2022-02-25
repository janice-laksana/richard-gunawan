@extends('layouts.user.app')

@section('content')
<section class="categories_banner_area">
    <div class="container">
        <div class="c_banner_inner">
            <h3>{{$jasa->jasa_name}}</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Jasa</a></li>
                <li class="current"><a href="product-details2.html">{{$jasa->jasa_name}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<!--================Product Details Area =================-->
<section class="product_details_area">
    <div class="container">
        @if ($message = Session::get('danger'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                This jasa has been <b>removed</b> from your wishlist!
            </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            This jasa has been <b>added</b> to your wishlist!
        </div>
        @endif
        <div class="row">
            <div class="col-lg-5">
                <div class="product_details_slider">
                    <div id="product_slider2" class="rev_slider" data-version="5.3.1.6">
                        <ul>	<!-- SLIDE  -->
                            <li data-index="rs-28" data-transition="scaledownfromleft" data-slotamount="default"  data-easein="default" data-easeout="default" data-masterspeed="1500"  data-thumb="img/product/product-details/p-details-tab-1.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Umbrella" data-param1="September 7, 2015" data-param2="Alfon Much, The Precious Stones" data-description="">
                                <!-- MAIN IMAGE -->
                                {{-- <img src="img/product/product-details/p-details-big-1.jpg"  alt=""  width="1920" height="1080" data-lazyload="img/product/product-details/p-details-big-1.jpg" data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina> --}}
                                @if (strpos($jasa->jasa_img, '://') == false)
                                    <img src="/storage/img/jasa/{{$jasa->jasa_img}}"  alt=""  width="1920" height="1080" data-lazyload="img/product/product-details/p-details-big-1.jpg" data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                @else
                                    <img class="img-fluid" src="{{$jasa->jasa_img}}" alt="">
                                @endif
                                <!-- LAYERS -->
                            </li>
                           {{-- <li data-index="rs-303" data-transition="scaledownfromleft" data-slotamount="default"  data-easein="default" data-easeout="default" data-masterspeed="1500"  data-thumb="img/product/product-details/p-details-tab-2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="The Dreaming Girl" data-param1="September 6, 2015" data-param2="Lol" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="img/product/product-details/p-details-big-1.jpg"  alt=""  width="1920" height="1080" data-lazyload="img/product/product-details/p-details-big-1.jpg" data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                <!-- LAYERS -->
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="product_details_text">
                    <h3>{{$jasa->jasa_name}}</h3>
                    <ul class="p_rating">
                        @for ($i = 0; $i < intval($jasa->jasa_rating); $i++)
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                        @endfor
                        @for ($i = 0; $i < (5 - intval($jasa->jasa_rating)); $i++)
                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                        @endfor
                    </ul>
                    <div class="add_review">
                        <a href="#">{{ number_format($jasa->jasa_rating,1) }}</a>
                        <a href="#">{{ $jasa->review->count() }} Reviews</a>
                    </div>
                    <h6>for <span>{{$jasa->category->category_name}}</span></h6>
                    <span>{{$jasa->jasa_days}} Days</span>
                    <h4>Rp. {{ number_format($jasa->jasa_price) }}</h4>
                    <p>{{$jasa->jasa_desc ?? 'No description available' }}</p>
                    @if ($jasa->user_id != Auth::id())
                    <div class="row">
                        <div class="quantity col-6" style="max-width: 35%; padding-right: 0">
                            <form action="{{ url('seller/jasa/order') }}" method="post">
                                @csrf
                                <input type="hidden" name="jasa_id" value="{{ $jasa->jasa_id }}">
                                <button type="submit" class="add_cart_btn">Add to cart</button>
                            </form>
                        </div>
                        <div class="quantity col-6" style="max-width: 0%; padding-left: 0">
                            @if (Auth::user()->id != $jasa->user_id)
                                <ul class="c_product_btn">
                                    <li class="p_icon">
                                        <a href="{{url('/wishlist'.'/'. Auth::user()->id.'/'. $jasa->jasa_id)}}" style="margin-top: 6px;">
                                            @if ($wish >0)
                                                <i class="icon_heart"></i>
                                            @else
                                                <i class="icon_heart_alt"></i>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>

                        <button onclick="firstchat({{$jasa->user_id}})" class="btn shop_now_btn form-control">Chat Seller</button>
                    </div>
                    @endif
                </div>
                <div class="product_table_details">
                    <div class="table-responsive-md">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Price Detail:</th>
                                    <td>
                                        <p>{{$jasa->jasa_descPrice}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Requirements:</th>
                                    <td>
                                        <p>{{$jasa->jasa_req}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="product_description_area">
    <div class="container">
      <nav class="tab_menu">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">Ulasan</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
            @if(Session::has('success-review'))
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{Session::get('success-review')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            @if(Session::has('fail-review'))
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('fail-review')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            @if ($jasa->user_id != Auth::id() && count($transaksi) > 0)
            <form class="billing_inner row" method="post" action="{{ url('seller/jasa/addReview' . '/' . $jasa->jasa_id) }}">
              @csrf
                <div class="col-lg-12">
                <div class="form-group">
                  <label for="desc">
                    <h4>Segera berikan ulasan untuk kami !</h4>
                  </label>
                  <input type="hidden" name="star" id="star" value="5">
                  <ul>
                    <li><a onclick="setStar(1)"><i id="star1" class="fa fa-star"></i></a></li>
                    <li><a onclick="setStar(2)"><i id="star2" class="fa fa-star"></i></a></li>
                    <li><a onclick="setStar(3)"><i id="star3" class="fa fa-star"></i></a></li>
                    <li><a onclick="setStar(4)"><i id="star4" class="fa fa-star"></i></a></li>
                    <li><a onclick="setStar(5)"><i id="star5" class="fa fa-star"></i></a></li>
                  </ul>
                  <textarea name="review" class="form-control" id="desc" rows="3" placeholder="Ulasanmu ..."></textarea>
                </div>
              </div>
              <div class="col-lg-2 form-group">
                <button type="submit" value="submit" class="btn subs_btn form-control">Tambahkan</button>
              </div>
            </form>
            @endif

            <hr>
            @forelse ($jasa->review as $review)
            <hr>
            <h4>{{ $review->user_name }}</h4>
            <p>{{ $review->review_message }}</p>
            <ul>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->review_star)
                    <li><i class="fa fa-star"></i></li>
                    @else
                    <li><i class="fa fa-star-o"></i></li>
                    @endif
                @endfor
            </ul>
            @empty
            <div class="row justify-content-center">
                <p>Tidak Ada Ulasan!</p>
            </div>
            @endforelse


        </div>
      </div>
    </div>
</section>
@endsection

@section('customjs')
<script>
    function setStar(star) {
      for (let i = 1; i <= 5; i++) {
        if (i <= star) {
          $('#star' + i).removeClass('fa-star-o');
          $('#star' + i).addClass('fa-star');
        } else {
          $('#star' + i).removeClass('fa-star');
          $('#star' + i).addClass('fa-star-o');
        }
      }
      $('#star').val(star);
    }

    function firstchat(tujuan) {
        // console.log(tujuan);
        var value = {
            "_token": "{{ csrf_token() }}",
            receiver: tujuan,
            message: "Kamu sudah dapat memulai chat"
        }
        $.ajax({
            type: "POST",
            url: '/chat/send',
            data: value,
            dataType: 'JSON',
            cache: false,
            success:function(data){
                alert(data);
            }
        });

        window.location = "{{ url('/chat') }}";

        // //redirect ke chat
    }
</script>
@endsection
