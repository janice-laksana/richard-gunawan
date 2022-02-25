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

    <style>
        .imgpro {
            width: 270px;
            height: 270px;
        }
    </style>
    <!--================Slider Area =================-->
    <section class="main_slider_area">
        <div class="container">
            <div id="main_slider" class="rev_slider" data-version="5.3.1.6">
                <ul>
                    <li data-index="rs-1587" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="img/home-slider/slider-1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="{{ asset('img/home-slider/slider.png') }}"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        <!-- LAYER NR. 1 -->
                        <div class="slider_text_box">
                            <div class="tp-caption tp-resizeme first_text"
                            data-x="['right','right','right','center','center']"
                            data-hoffset="['0','0','0','0']"
                            data-y="['top','top','top','top']"
                            data-voffset="['60','60','60','80','95']"
                            data-fontsize="['54','54','54','40','40']"
                            data-lineheight="['64','64','64','50','35']"
                            data-width="['470','470','470','300','250']"
                            data-height="none"
                            data-whitespace="['nowrap','nowrap','nowrap','nowrap','nowrap']"
                            data-type="text"
                            data-responsive_offset="on"
                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                            data-textAlign="['left','left','left','left','left','center']"
                            style="z-index: 8;font-family: Montserrat,sans-serif;font-weight:700;color:#29263a;"><img src="{{ asset('img/home-slider/2020-text.png') }}" alt=""></div>

                            <div class="tp-caption tp-resizeme secand_text"
                                data-x="['right','right','right','center','center',]"
                                data-hoffset="['0','0','0','0']"
                                data-y="['top','top','top','top']" data-voffset="['255','255','255','230','220']"
                                data-fontsize="['48','48','48','48','36']"
                                data-lineheight="['52','52','52','46']"
                                data-width="['450','450','450','450','450']"
                                data-height="none"
                                data-whitespace="normal"
                                data-type="text"
                                data-responsive_offset="on"
                                data-transform_idle="o:1;"
                                data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                data-textAlign="['left','left','left','left','left','center']"
                                >Best Service <br />Collection
                            </div>

                            <div class="tp-caption tp-resizeme third_btn"
                                data-x="['right','right','right','center','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['top','top','top','top']" data-voffset="['385','385','385','385','350']"
                                data-width="['450','450','450','auto','auto']"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-type="text"
                                data-responsive_offset="on"
                                data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                data-textAlign="['left','left','left','left','left','center']">
                                <a class="checkout_btn" href="{{ url('/jasa') }}">more</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Slider Area =================-->

    <!--================Our Latest Product Area =================-->
    <section class="our_latest_product">
        <div class="container">
            <div class="s_m_title">
                <h2>Jasa Terbaru Kami</h2>
            </div>
            <div class="l_product_slider owl-carousel">
                @forelse ($recentjasa as $item)
                    <div class="item">
                        <div class="l_product_item">
                            <div class="l_p_img">
                                @if (strpos($item->jasa_img, '://') == false)
                                    <img src="/storage/img/jasa/{{$item->jasa_img}}"  alt=""  class="imgpro">
                                @else 
                                    <img class="imgpro" src="{{$item->jasa_img}}" alt="">                                    
                                @endif
                            </div>
                            <div class="l_p_text">
                                <ul>
                                    <li><a class="add_cart_btn" href="{{ url('seller/jasa/show/'.$item->jasa_id) }}">Detail</a></li>
                                    @if ($auth != null)
                                    <li class="p_icon"><a onclick="addToWishlist({{$item->jasa_id}},{{$auth->id}})">
                                        <div class="btnWishlist{{$item->jasa_id}}">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        </a></li>    
                                    @endif
                                </ul>
                                <h4>{{ $item->jasa_name }}</h4>
                                <h5>Rp.<?= number_format($item->jasa_price) ?></h5>
                            </div>
                        </div>
                    </div>
                @empty
                    Kosong
                @endforelse
            </div>
        </div>
    <!--================End Our Latest Product Area =================-->
    <!--================Recommended Product Area =================-->
        <div class="container">
            <div class="s_m_title">
                <h2 style="display:inline-block;margin-right:75px;">Rekomendasi</h2><a style="line-height:26px;" class="add_cart_btn" href="#" onclick="resetrec()">Reset Ulang Rekomendasi</a>
            </div>
            <div class="l_product_slider owl-carousel">
                @forelse ($recojasa as $item)
                    <div class="item">
                        <div class="l_product_item">
                            <div class="l_p_img">
                                @if (strpos($item->jasa_img, '://') == false)
                                    <img src="/storage/img/jasa/{{$item->jasa_img}}"  alt=""  class="imgpro">
                                @else 
                                    <img class="imgpro" src="{{$item->jasa_img}}" alt="">                                    
                                @endif
                            </div>
                            <div class="l_p_text">
                                <ul>
                                    <li><a class="add_cart_btn" href="{{ url('seller/jasa/show/'.$item->jasa_id) }}">Detail</a></li>
                                    @if ($auth != null)
                                    <li class="p_icon"><a onclick="addToWishlist({{$item->jasa_id}},{{$auth->id}})">
                                        <div class="btnWishlist{{$item->jasa_id}}">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        </a></li>    
                                    @endif
                                </ul>
                                <h4>{{ $item->jasa_name }}</h4>
                                <h5>Rp.<?= number_format($item->jasa_price) ?></h5>
                            </div>
                        </div>
                    </div>
                @empty
                    Kosong
                @endforelse
            </div>
        </div>
    </section>
    <!--================End Recommended Product Area =================-->
    <!--================Form Blog Area =================-->
    <section class="from_blog_area">
        <div class="container">
            <div class="from_blog_inner">
                <div class="c_main_title">
                    <h2>Why you should trust us</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="from_blog_item">
                            <img class="img-fluid" src="{{ asset('img/blog/from-blog/satu-1.jpg') }}" alt="">
                            <div class="f_blog_text">
                                <h5>Grow</h5>
                                <p>We Grow Together</p>
                                <h6>14 11 2020</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="from_blog_item">
                            <img class="img-fluid" src="{{ asset('img/blog/from-blog/dua-2.jpg') }}" alt="">
                            <div class="f_blog_text">
                                <h5>Safe Payments</h5>
                                <p>Every payments are safe</p>
                                <h6>14 11 2020</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="from_blog_item">
                            <img class="img-fluid" src="{{ asset('img/blog/from-blog/tiga-3.jpg') }}" alt="">
                            <div class="f_blog_text">
                                <h5>Protected</h5>
                                <p>Your personal data are save</p>
                                <h6>14 11 2020</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Form Blog Area =================-->

    <script>
        function goSearch(event){
            // var searchBar = "?search=" + $("#searchBar").val();
            window.location.href = '/goSearch/' + $("#searchBar").val();
        }

        function addToWishlist(jasa_id, user_id) {

        }

        function resetrec() {
            $.ajax({
                url: '{{ url('/home/resetrecommend') }}',
                cache: false,
                success: function (data) {
                    console.log(data);
                    window.location.href = '{{ url('/home') }}';
                },
                error: function (e) {
                    console.log(e);
                    window.location.href = '{{ url('/home') }}';
                }
            });
        }
    </script>
@endsection
