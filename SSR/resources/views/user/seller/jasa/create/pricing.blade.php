@extends('layouts.user.app')

@section('content')
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Pricing</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#"><b>Pricing</b></a></li>
                <li><a href="#">Description & Requirements</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Post!</a></li>
            </ul>
        </div>
    </div>
</section>
<section class="track_area p_100">
        <div class="container">
            <div class="login_inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login_title">
                            <h2>Jasa Pricing</h2>
                            <p> Name your price!</p>
                        </div>
                        <form class="login_form row" action="/seller/jasa/doCreate/1" method="POST">
                            @csrf
                            <div class="col-lg-2 form-group">
                                <label for="jasa_price">The Price</label>
                                <div class="quantity" style="margin-top: 0">
                                    <div class="custom">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value=parseInt(result.value)-10000;return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                        <input type="text" id="sst" maxlength="12" value="10000" title="Quantity:" class="input-text qty" name="jasa_price" value="{{old('jasa_price')}}">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value=parseInt(result.value)+10000;return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 form-group">
                                <label for="jasa_descPrice">Price Detail</label>
                                <textarea name="jasa_descPrice" id="jasa_descPrice" cols="15" rows="5" class="form-control" placeholder="Describe what your price holds here..." required>{{old('jasa_descPrice')}}</textarea>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="jasa_days">Days of Delivery</label>
                                <div class="quantity" style="margin-top: 0">
                                    <div class="custom">
                                        <button onclick="var result = document.getElementById('sst2'); var sst2 = result.value; if( !isNaN( sst2 ) &amp;&amp; sst2 > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                        <input type="text" id="sst2" maxlength="12" value="1" title="Quantity:" class="input-text qty" name="jasa_days" value="{{old('jasa_days')}}">
                                        <button onclick="var result = document.getElementById('sst2'); var sst2 = result.value; if( !isNaN( sst2 )) result.value++;return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" value="submit" class="btn subs_btn form-control">Write Descriptions and Requirements</button>
                            </div>
                            <div class="col-lg-12 form-group">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div style="color:red;">{{ $error }}</div><br>
                                    @endforeach
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="row justify-content-center">
    <div class="col-md-8">
    </div>
</div>
@endsection
