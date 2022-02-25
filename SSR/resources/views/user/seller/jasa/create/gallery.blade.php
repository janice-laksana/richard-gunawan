@extends('layouts.user.app')

@section('content')
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Gallery</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Description & Requirements</a></li>
                <li><a href="#"><b>Gallery & Post!</b></a></li>
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
                            <h2>Gallery</h2>
                            <p> Give some ideas what's your jasa like!</p>
                        </div>
                        <form class="login_form row" action="/seller/jasa/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="jasa_name" value="{{$data[0]->jasa_name}}">
                            <input type="hidden" name="kat_skill_id" value="{{$data[0]->kat_skill_id}}">
                            <input type="hidden" name="jasa_price" value="{{$data[1]->jasa_price}}">
                            <input type="hidden" name="jasa_descPrice" value="{{$data[1]->jasa_descPrice}}">
                            <input type="hidden" name="jasa_days" value="{{$data[1]->jasa_days}}">
                            <input type="hidden" name="jasa_desc" value="{{$data[2]->jasa_desc}}">
                            <input type="hidden" name="jasa_req" value="{{$data[2]->jasa_req}}">
                            <div class="col-lg-12 form-group">
                                <label for="jasa_pic">Insert Image</label>
                                <input type="file" src="" alt="" name="image" class="form-control" required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" value="submit" class="btn subs_btn form-control">Post Now!</button>
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