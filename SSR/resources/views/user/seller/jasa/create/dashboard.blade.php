@extends('layouts.user.app')

@section('content')
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Dashboard</h3>
            <ul>
                <li><a href="#"><b>Dashboard</b></a></li>
                <li><a href="#">Pricing</a></li>
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
                            <h2>Jasa Dashboard</h2>
                            <p> Pull in customers to your business!</p>
                        </div>
                        <form class="login_form row" action="/seller/jasa/doCreate/0" method="POST">
                            @csrf
                            <div class="col-lg-12 form-group">
                                <label for="text">Jasa Title</label>
                                <input class="form-control" type="text" name="jasa_name" id="jasa_name" required value="{{old('jasa_name')}}">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="kat_skill_id">Category</label>
                                <select name="kat_skill_id" name="kat_skill_id" class="form-control">
                                    @forelse ($category as $c)
                                    <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                                    @empty
                                    <option value="">-</option>                                            
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" value="submit" class="btn subs_btn form-control">Price My Jasa</button>
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
