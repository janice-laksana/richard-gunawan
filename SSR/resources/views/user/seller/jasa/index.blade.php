@extends('layouts.user.app')

@section('content')
<section class="categories_product_main">
    <div class="container">
        <section class="categories_banner_area" style="margin-bottom: 40px">
            <div class="container">
                <div class="c_banner_inner">
                    <h3>My Jasa</h3>
                    <ul>
                        <li class="current"><a href="#">Organize your Jasa as you wish!</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="categories_main_inner">
            <div class="row row_disable">
                <div class="col-lg-12 float-md-right">
                    <div class="showing_fillter">
                        <div class="row m0">
                            <div class="first_fillter">

                            </div>
                            <div class="four_fillter"> </div>
                            {{-- <div class="secand_fillter">
                              <h4>Sort :</h4>
                              <select class="selectpicker" id="filterSortBy" onchange="refreshItems()">
                                <option value="created_at">Date</option>
                                <option value="jasa_name">Name</option>
                                <option value="jasa_price">Price</option>
                              </select>
                            </div>
                            <div class="secand_fillter">
                              <h4></h4>
                                <select class="selectpicker" id="filterAscDesc" onchange="refreshItems()" style="width:100px;">
                                    <option value="desc">Descending</option>
                                    <option value="asc">Ascending</option>
                                </select>
                            </div> --}}
                            <input type="hidden" name="indexTab" id="indexTab" value="0">
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Please the recent update form you accessed for errors
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ $message }}
                    </div>
                    @endif
                    @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ $message }}
                    </div>
                    @endif
                    <input type="hidden" name="hdnStatus" value="nav-coba" id="hdnStatus">
                    <input type="hidden" name="hdnID" value="{{Auth::user()->id}}" id="hdnID">
                    <nav class="tab_menu" style="padding: 0 0 20px 0;">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-coba-tab" data-toggle="tab" href="#nav-coba" role="tab" aria-controls="nav-coba" aria-selected="true" onclick="changeTab(0)">Aktif <span class="badge badge-primary">{{count($jasaAktif)}}</span></a>
                            <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false" onclick="changeTab(1)">Pending <span class="badge badge-warning">{{count($jasaPending)}}</span></a>
                            <a class="nav-item nav-link" id="nav-canceled-tab" data-toggle="tab" href="#nav-canceled" role="tab" aria-controls="nav-canceled" aria-selected="false" onclick="changeTab(2)">Batal<span class="badge badge-danger">{{count($jasaCancel)}}</span></a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{-- TAB AKTIF --}}
                        <div class="tab-pane fade show active" id="nav-coba" role="tabpanel" aria-labelledby="nav-coba-tab">
                            @forelse ($jasaAktif as $j)
                            <div class="c_product_item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="c_product_img">
                                            @if (strpos($j->jasa_img, '://') == false)
                                                <img src="/storage/img/jasa/{{$j->jasa_img}}"  alt=""  class="img-fluid">
                                            @else 
                                                <img class="img-fluid" src="{{$j->jasa_img}}" alt="">                                    
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6" style="top-padding: 10px;">
                                        <div class="c_product_text">
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
                                                    <button style="cursor: pointer;" class="add_cart_btn" style="background-color:red;border-color:red;" onclick="cancelJasa({{$j->jasa_id}});">Delete</button>
                                                </li>
                                            </ul>
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
                        </div>
                        {{-- TAB PENDING --}}
                        <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                            @forelse ($jasaPending as $j)
                            <div class="c_product_item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="c_product_img">
                                            @if (strpos($j->jasa_img, '://') == false)
                                                <img src="/storage/img/jasa/{{$j->jasa_img}}"  alt=""  class="img-fluid">
                                            @else 
                                                <img class="img-fluid" src="{{$j->jasa_img}}" alt="">                                    
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6" style="top-padding: 10px;">
                                        <div class="c_product_text">
                                            <h3>{{$j->jasa_name}}</h3>
                                            <h5>Rp. <?php echo number_format($j->jasa_price, 0, '.', ',');  ?>,-</h5>
                                            <h6><span id="status" style="color:grey;">Belum Teraktivasi</span></h6>
                                            <span style="font-style:italic;">{{$j->created_at}}</span>
                                            <p>{{ \Illuminate\Support\Str::limit($j->jasa_desc, 150, $end='...') }}</p>
                                            <ul class="c_product_btn">
                                                {{-- <li><button style="cursor: pointer; margin: 0 7px 0 0;" class="add_cart_btn" >Update</button></li> --}}
                                                <li><button style="cursor: pointer; margin: 0 7px 0 0;" class="add_cart_btn" data-toggle="modal" data-target="#exampleModal" onclick="editData({{$j->jasa_id}})">Update</button></li>
                                                <li style="background-color:red;">
                                                    <button style="cursor: pointer;" class="add_cart_btn" style="background-color:red;border-color:red;" onclick="cancelJasa({{$j->jasa_id}});">Delete</button>
                                                </li>
                                            </ul>
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
                        </div>
                        {{-- TAB CANCELED --}}
                        <div class="tab-pane fade" id="nav-canceled" role="tabpanel" aria-labelledby="nav-canceled-tab">
                            @forelse ($jasaCancel as $j)
                            <div class="c_product_item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="c_product_img">
                                            @if (strpos($j->jasa_img, '://') == false)
                                                <img src="/storage/img/jasa/{{$j->jasa_img}}"  alt=""  class="img-fluid">
                                            @else 
                                                <img class="img-fluid" src="{{$j->jasa_img}}" alt="">                                    
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6" style="top-padding: 10px;">
                                        <div class="c_product_text">
                                            <h3>{{$j->jasa_name}}</h3>
                                            <h5>Rp. <?php echo number_format($j->jasa_price, 0, '.', ',');  ?>,-</h5>
                                            <h6><span id="status" style="color:red;">Dibatalkan</span></h6>
                                            <span style="font-style:italic;">{{$j->created_at}}</span>
                                            <p>{{ \Illuminate\Support\Str::limit($j->jasa_desc, 150, $end='...') }}</p>
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
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit My Jasa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formEdit" action="{{url('')}}"  method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <span style="color:red;">{{ $error }}</span><br>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Jasa Title</label>
                                        <input class="form-control" type="text" name="jasa_name" id="jasa_name" required value="{{old('jasa_name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kat_skill_id">Category</label>
                                        <select name="kat_skill_id" id="kat_skill_id" class="form-control">
                                            @forelse ($category as $c)
                                                <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                                            @empty
                                                <option value="">-</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jasa_price">The Price</label>
                                        <div class="quantity" style="margin-top: 0">
                                            <div class="custom">
                                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                                <input type="text" id="sst" maxlength="12" value="10000" title="Quantity:" class="input-text qty" name="jasa_price" id="jasa_price">
                                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value=parseInt(result.value)+10000;return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jasa_descPrice">Price Detail</label>
                                        <textarea name="jasa_descPrice" id="jasa_descPrice" cols="15" rows="5" class="form-control" placeholder="Describe what your price holds here..." required>{{old('jasa_descPrice')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jasa_days">Days of Delivery</label>
                                        <div class="quantity" style="margin-top: 0">
                                            <div class="custom">
                                                <button onclick="var result2 = document.getElementById('sst2'); var sst2 = result2.value; if( !isNaN( sst2 ) &amp;&amp; sst2 > 0 ) result2.value--;return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                                <input type="text" id="sst2" maxlength="12" value="1" title="Quantity:" class="input-text qty" name="jasa_days">
                                                <button onclick="var result2 = document.getElementById('sst2'); var sst2 = result2.value; if( !isNaN( sst2 )) result2.value++;return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jasa_desc">Description</label>
                                        <textarea name="jasa_desc" id="jasa_desc" cols="15" rows="5" class="form-control" placeholder="Describe what your jasa is about..." required>{{old('jasa_desc')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jasa_req">Requirements</label>
                                        <textarea name="jasa_req" id="jasa_req" cols="15" rows="5" class="form-control" placeholder="What are the requirements? (Ex: PDF File, DOCX/DOC file)" required>{{old('jasa_req')}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" value="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
<script>
    function editData(id) {
        // var pageURL = $(location).attr("pathname");
        $.ajax({
            "method": "post",
            "url": '/seller/jasa/showupdate',
            "data": {
                "_token": "{{csrf_token()}}",
                idJasa : id,
            },
            "success": function(data) {
                $("#jasa_name").val(data["jasa_name"]);
                $("#kat_skill_id").val(data["kat_skill_id"]);
                $("#sst").val(data["jasa_price"]);
                $("#jasa_descPrice").val(data["jasa_descPrice"]);
                $("#sst2").val(data["jasa_days"]);
                $("#jasa_desc").val(data["jasa_desc"]);
                $("#jasa_req").val(data["jasa_req"]);
                $("#formEdit").attr('action','/seller/jasa/update/'+id)
            },
            "error": function(error) {
                alert('error');
                console.log(error);
            }
        });
    }

    function cancelJasa(jasa_id){
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat mengembalikan aksi ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, delete !"
            }).then(result => {
            if (result.value) {
                $.ajax({
                    "method": "post",
                    "url": "/seller/jasa/delete",
                    "data":{
                        "_token": "{{csrf_token()}}",
                        id : jasa_id
                    },
                    "success": function(data) {
                        window.location = '/seller/jasa'
                    },
                    "error": function(error) {
                        console.log(error);
                        alert('error');
                        Swal.fire("Not Deleted!", "Jasa Gagal dihapus.", "error");
                    }
                });
            }
        });
    }

    function refreshItems() {
        var sortBy = $("#filterSortBy").val();
        var ascDesc = $("#filterAscDesc").val();
        var divItems = $("#hdnStatus").val();
        var user_id = $("#hdnID").val();
        var indexTab = $("#indexTab").val();
        
        var status = -1;
        if(divItems == "nav-coba") status = 1;
        else if(divItems == "nav-pending") status = 0;
        else if(divItems == "nav-canceled") status = 2;

        $.ajax({
            "method": "post",
            "url": '/seller/jasa/ajaxMyJasa',
            "data": {
                "_token": "{{csrf_token()}}",
                sortBy : sortBy,
                ascDesc : ascDesc,
                status : status,
                user_id:user_id
            },
            "success": function(data) {
                // alert(data);
                $("#"+divItems).html(data);
            },
            "error": function(error) {
                alert('error');
                console.log(error);
            }
        });
    }

    function changeTab(indexTab) {
        $("#indexTab").val(indexTab);
    }

    </script>
@endsection
