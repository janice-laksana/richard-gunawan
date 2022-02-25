@forelse ($jasa as $j)
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
        <div class="col-lg-8 col-md-6" style="top-padding: 10px;">
            <div class="c_product_text">
                @if($j->status == 0)
                    <h3>{{$j->jasa_name}}</h3>
                    <h5>Rp. <?php echo number_format($j->jasa_price, 0, '.', ',');  ?>,-</h5>
                    <h6><span id="status">Active</span></h6>
                    <span style="font-style:italic;">{{$j->created_at}}</span>
                    <p>{{ \Illuminate\Support\Str::limit($j->jasa_desc, 150, $end='...') }}</p>
                    <ul class="c_product_btn">
                        <li style="background-color:green;">
                            <form action="{{url('seller/jasa/show/'.$j->jasa_id)}}" method="GET">
                                <button style="cursor: pointer;" class="add_cart_btn" >Details</button>
                            </form>
                        </li>
                        <li style="background-color:red;">
                            <form action="{{url('seller/jasa/delete/'.$j->jasa_id)}}" method="GET">
                                <button style="cursor: pointer;" class="add_cart_btn" style="background-color:red;border-color:red;">Delete</button>
                            </form>
                        </li>
                    </ul>
                @elseif($j->status == 1)
                    <h3>{{$j->jasa_name}}</h3>
                    <h5>Rp. <?php echo number_format($j->jasa_price, 0, '.', ',');  ?>,-</h5>
                    <h6><span id="status" style="color:grey;">Belum Teraktivasi</span></h6>
                    <span style="font-style:italic;">{{$j->created_at}}</span>
                    <p>{{ \Illuminate\Support\Str::limit($j->jasa_desc, 150, $end='...') }}</p>
                    <ul class="c_product_btn">
                        {{-- <li><button style="cursor: pointer; margin: 0 7px 0 0;" class="add_cart_btn" >Update</button></li> --}}
                        <li><button style="cursor: pointer; margin: 0 7px 0 0;" class="add_cart_btn" data-toggle="modal" data-target="#exampleModal" onclick="editData({{$j->jasa_id}})">Update</button></li>
                        <li style="background-color:red;">
                            <form action="{{url('seller/jasa/delete/'.$j->jasa_id)}}" method="GET">
                                <button style="cursor: pointer;" class="add_cart_btn" style="background-color:red;border-color:red;">Delete</button>
                            </form>
                        </li>
                    </ul>
                @elseif($j->status == 2)
                    <h3>{{$j->jasa_name}}</h3>
                    <h5>Rp. <?php echo number_format($j->jasa_price, 0, '.', ',');  ?>,-</h5>
                    <h6><span id="status" style="color:red;">Dibatalkan</span></h6>
                    <span style="font-style:italic;">{{$j->created_at}}</span>
                    <p>{{ \Illuminate\Support\Str::limit($j->jasa_desc, 150, $end='...') }}</p>
                    <ul class="c_product_btn">
                        <li style="background-color:green;"><button style="cursor: pointer;" class="add_cart_btn" >Details</button></li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
    <div class="login_title" style="text-align:center;">
        <h2><br>NO DATA FOUND</h2>
        <a href="{{url('/seller/jasa/create/0')}}">Click here</a> to make sessions!
    </div>
@endforelse