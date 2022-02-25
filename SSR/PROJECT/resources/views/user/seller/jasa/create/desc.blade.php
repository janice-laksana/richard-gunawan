@extends('layouts.user.app')

@section('content')
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Description & Requirements</h3>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#"><b>Description & Requirements</b></a></li>
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
                            <h2>Description Jasa & Requirements</h2>
                            <p> Tell them what it's all about and what you need!</p>
                        </div>
                        <form class="login_form row" action="/seller/jasa/doCreate/2" method="POST">
                            @csrf
                            <div class="col-lg-6 form-group">
                                <label for="jasa_desc">Description</label>
                                <textarea name="jasa_desc" id="jasa_desc" cols="15" rows="5" class="form-control" placeholder="Describe what your jasa is about..." required>{{old('jasa_desc')}}</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="jasa_req">Requirements</label>
                                <textarea name="jasa_req" id="jasa_req" cols="15" rows="5" class="form-control" placeholder="What are the requirements? (Ex: PDF File, DOCX/DOC file)" required>{{old('jasa_req')}}</textarea>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" value="submit" class="btn subs_btn form-control">I'm Almost Done</button>
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
