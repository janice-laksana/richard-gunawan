@extends('layouts.user.app')

@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>LOgin</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="track.html">Login</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<!--================login Area =================-->
<section class="login_area p_100">
    <div class="container">
        <div class="login_inner">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="login_title">
                        <h2>log in your account</h2>
                        <p>Log in to your account to discovery all great features in this template.</p>
                    </div>
                    <form class="login_form row" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-lg-12 form-group">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            {{-- <div class="creat_account">
                                <input type="checkbox" id="f-option" name="selector">
                                <label for="f-option">Keep me logged in</label>
                                <div class="check"></div>
                            </div> --}}
                            <a href="{{ url('register') }}"><caption>Register</caption></a>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" value="submit" class="btn update_btn form-control">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End login Area =================-->

@endsection
