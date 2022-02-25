@forelse ($jasas as $jasa)
    <div class="c_product_item">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="c_product_img">
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
                        @if (Auth::user()->is_vendor != 0)
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
