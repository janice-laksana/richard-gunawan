@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <section class="best_summer_banner">
        <img class="img-fluid" src="img/banner/summer-banner.jpg" alt="" style="height: 50%;">
        <div class="container">
            <div class="summer_text" >
                <h3>Customize your profile</h3>
            </div>
        </div>
    </section>

    <section class="product_description_area bg-white p_80">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-10">
              @if(Session::has('success'))
              <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              @else
                <div class="col-lg-12 form-group">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span style="color:red;">{{ $error }}</span><br>
                        @endforeach
                    @endif
                </div>
              @endif
              <nav class="tab_menu">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">General </a>
                  <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Detail </a>
                  <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-privacy" role="tab" aria-controls="nav-privacy" aria-selected="false">Privacy </a>
                  <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-skills" role="tab" aria-controls="nav-skills" aria-selected="false">Skills </a>
                  {{-- <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Education </a> --}}
                  <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-sertif" role="tab" aria-controls="nav-sertif" aria-selected="false">Certification </a>
                </div>
              </nav>

              <div class="tab-content" id="nav-tabContent">
                
                <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                          <div class="container">
                            <h1>General</h1>
                            <form class="row" action="{{url('/profile/update/0')}}" method="POST">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" id="username" disabled value="{{Auth::user()->username ? Auth::user()->username :'-'}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="user_email">Email</label>
                                    <input class="form-control" type="email" id="user_email" disabled value="{{Auth::user()->email ? Auth::user()->email :'-'}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="user_name">Name</label>
                                    <input class="form-control" type="text" name="user_name" value="{{Auth::user()->name ? Auth::user()->name :'-'}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="user_phone">Phone Number</label>
                                    <input class="form-control" type="text" name="user_phone" value="{{Auth::user()->user_phone ? Auth::user()->user_phone :'-'}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Update</button>
                                </div>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                        <div class="container">
                            <h1>Detail Account</h1>
                            <form class="row" action="{{url('/profile/update/1')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="user_age">Age</label>
                                    <input class="form-control" type="number" name="user_age" value="{{Auth::user()->user_age ? Auth::user()->user_age :'-'}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="nationality_id">Nationality</label>
                                    <select name="nationality_id" name="nationality_id" class="form-control">
                                        @foreach ($nations as $n)
                                            <option value="{{$n->nationality_id}}" {{Auth::user()->nationality_id==$n->nationality_id?'selected':''}}>
                                                {{$n->nationality_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="user_gender">Gender</label>
                                    <select name="user_gender" name="user_gender" class="form-control">
                                        <option value="0" {{Auth::user()->user_gender==0?'selected':''}}>Male</option>
                                        <option value="1" {{Auth::user()->user_gender==1?'selected':''}}>Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="Description">User Description</label>
                                    <textarea class="form-control" name="user_desc" name="user_desc" cols="15" rows="10">{{Auth::user()->user_desc ? Auth::user()->user_desc :'-'}}</textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Update</button>
                                </div>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                          <div class="container">
                            <h1>Privacy</h1>
                            <form class="row" action="{{url('/profile/update/2')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="text">Password</label>
                                    <input class="form-control" type="password" name="pass">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="text">Confirm Password</label>
                                    <input class="form-control" type="password" name="confirm">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Update</button>
                                </div>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-skills" role="tabpanel" aria-labelledby="nav-skills-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                          <div class="container">
                            <h1>Skills</h1>
                            <form class="row" action="{{url('/profile/insert/3')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="skill_name">My Skill</label>
                                    <input class="form-control" type="text" name="skill_name" placeholder="Translation ING-IND (Vice Versa)">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="kategori_id">Category</label>
                                    <select name="kategori_id" name="kategori_id" class="form-control">
                                        @forelse ($category as $c)
                                            <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                                        @empty
                                            <option value="">-</option>                                            
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Add</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="f_product_left">
                                        <div class="s_m_title">
                                            <br><h2>Skills</h2>
                                        </div>
                                        <div class="f_product_inner">
                                            <div class="media">
                                                <div class="media-body">
                                                    @forelse ($skill as $s)
                                                        <b>{{$s->skill_name}}</b> for <i>{{$s->category->category_name}}</i><br>
                                                    @empty
                                                        <b>Skill Name</b> for <i>2000</i> 
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                          <div class="container">
                            <h1>Education</h1>
                            <form class="row" action="{{url('/profile/insert/4')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="name">Institute Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="location">Institute Location</label>
                                    <input class="form-control" type="text" name="location">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="title">Title Given</label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="year">Year of Graduation</label>
                                    <input class="form-control" type="number" name="year">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Add</button>
                                </div>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-sertif" role="tabpanel" aria-labelledby="nav-sertif-tab">
                  <div class="items col-12 mt-4">
                      <div class="c_product_grid_details">
                        <div class="container">
                            <h1>Certification</h1>
                            <form class="row" action="{{url('/profile/insert/5')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 form-group">
                                    <label for="sertifikat_name">Certification Title</label>
                                    <input class="form-control" type="text" name="sertifikat_name">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="sertifikat_from">Awarded By</label>
                                    <input class="form-control" type="text" name="sertifikat_from">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="sertifikat_year">Year Given</label>
                                    <input class="form-control" type="number" name="sertifikat_year">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Add</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="f_product_left">
                                        <div class="s_m_title">
                                            <br><h2>Certifications</h2>
                                        </div>
                                        <div class="f_product_inner">
                                            <div class="media">
                                                <div class="media-body">
                                                    @forelse ($sertifikat as $s)
                                                        <b>{{$s->sertifikat_name}}</b> from {{$s->sertifikat_from}} <i>{{$s->sertifikat_year}}</i><br>
                                                    @empty
                                                        <b>Certification Title</b> from XXX <i>2000</i> 
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </section>

    <!--================Footer Area =================-->
    <footer class="footer_area box_footer">
        <div class="container">
            <div class="footer_widgets">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-6">
                        <aside class="f_widget f_about_widget">
                            <img src="img/logo.png" alt="">
                            <p>Persuit is a Premium PSD Template. Best choice for your online store. Let purchase it to enjoy now</p>
                            <h6>Social:</h6>
                            <ul>
                                <li><a href="#"><i class="social_facebook"></i></a></li>
                                <li><a href="#"><i class="social_twitter"></i></a></li>
                                <li><a href="#"><i class="social_pinterest"></i></a></li>
                                <li><a href="#"><i class="social_instagram"></i></a></li>
                                <li><a href="#"><i class="social_youtube"></i></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <aside class="f_widget link_widget f_info_widget">
                            <div class="f_w_title">
                                <h3>Information</h3>
                            </div>
                            <ul>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Delivery information</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Returns & Refunds</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <aside class="f_widget link_widget f_service_widget">
                            <div class="f_w_title">
                                <h3>Customer Service</h3>
                            </div>
                            <ul>
                                <li><a href="#">My account</a></li>
                                <li><a href="#">Ordr History</a></li>
                                <li><a href="#">Wish List</a></li>
                                <li><a href="#">Newsletter</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <aside class="f_widget link_widget f_extra_widget">
                            <div class="f_w_title">
                                <h3>Extras</h3>
                            </div>
                            <ul>
                                <li><a href="#">Brands</a></li>
                                <li><a href="#">Gift Vouchers</a></li>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Specials</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <aside class="f_widget link_widget f_account_widget">
                            <div class="f_w_title">
                                <h3>My Account</h3>
                            </div>
                            <ul>
                                <li><a href="#">My account</a></li>
                                <li><a href="#">Ordr History</a></li>
                                <li><a href="#">Wish List</a></li>
                                <li><a href="#">Newsletter</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================End Footer Area =================-->
</div>

@endsection
