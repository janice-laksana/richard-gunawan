@extends('layouts.user.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Register</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="track.html">Register</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<section class="login_area p_100">
    <div class="container">
        <div class="login_inner">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login_title">
                        <h2>create account</h2>
                        <p>Follow the steps below to create email account enjoy the great mail.com emailing experience. Vivamus tempus risus vel felis condimentum, non vehicula est iaculis.</p>
                    </div>
                    <form class="login_form row" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-lg-6 form-group">
                            <input placeholder="Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <input class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required type="text" placeholder="User Name">
                        </div>
                        <div class="col-lg-6 form-group">
                            <input class="form-control @error('user_phone') is-invalid @enderror" name="user_phone" value="{{ old('user_phone') }}" required type="text" placeholder="Phone">
                        </div>
                        <div class="col-lg-6 form-group">
                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="col-lg-6 form-group">
                            <button type="submit" value="submit" class="btn subs_btn form-control">register now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
