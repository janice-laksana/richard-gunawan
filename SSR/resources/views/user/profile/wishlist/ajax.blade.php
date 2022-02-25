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