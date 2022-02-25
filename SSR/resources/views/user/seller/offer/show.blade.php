@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">Your Custom Request</h2>
        </div>
        <div class="row justify-content-center">
          keterangan
        </div>
      </div>
    </div>


    <!--================Product Description Area =================-->
    <section class="product_description_area bg-white p_80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="c_product_grid_details">
                        <div class="c_product_item">
                            <div class="row justify-content-center">
                            <div class="col-10">
                                <div class="c_product_text">
                                    <h5>Status : {{ $list_status[$request->request_status] }}</h5>
                                    <h6>Interested User : <span>{{ $list_offer->count() }}</span></h6>

                                    <p>{{ $request->request_description }}</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        @forelse ($list_offer as $offer)
                        <div class="c_product_item" id="item-{{ $offer->offer_id }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="c_product_img">
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <img style="width: 100%; height: auto;" class="img-fluid" src="{{ asset('img/product/l-product-2.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6">
                                    <div class="c_product_text">
                                        <h1>{{ $offer->jasa->jasa_name }}</h1>
                                        <h6>
                                            By <a href="{{ url('/') }}">{{ $offer->user->name }}</a>
                                            <ul class="product_rating">
                                                <li><a><i class="fa fa-star"></i></a></li>
                                                <li><a><i class="fa fa-star"></i></a></li>
                                                <li><a><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </h6>
                                        <p>{{ $offer->offer_message }}</p>
                                        <h5>Rp. {{ number_format($offer->offer_price) }}</h5>
                                        <ul class="c_product_btn">
                                            <form action="{{ url('buyer/request/order') }}" method="get" id="form{{$offer->offer_id}}">
                                                @csrf
                                                <input type="hidden" name="offer_id" value="{{ $offer->offer_id }}">
                                                <input type="hidden" name="request_id" value="{{ $offer->request_id }}">
                                            </form>
                                            <li><a class="add_cart_btn text-white p-2" onclick="orderOffer({{ $offer->offer_id }}, {{ $request->request_id }})">Order offer</a></li>
                                            <li><a class="checkout_btn text-white" onclick="removeOffer({{ $offer->offer_id }})">Remove offer</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row justify-content-center">Belum ada penawaran</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Details Area =================-->
  </div>

@endsection
@section('customjs')
<script>
  function removeOffer(offer_id) {
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
          "method": "delete",
          "url": "{{ url('buyer/request/delete') }}",
          "data": {
            offer_id: offer_id,
            "_token": "{{ csrf_token() }}",
          },
          "success": function(data) {
            $('#item-' + offer_id).remove();
            Swal.fire("Deleted!", "File Anda telah dihapus.", "success");
          },
          "error": function(error) {
            console.log(error);
            Swal.fire("Not Deleted!", "File Gagal dihapus.", "error");
          }
        });
      }
    });
  }

  function orderOffer(offer_id, request_id) {
    $('#form' + offer_id).submit();

    // $.ajax({
    //   "method": "post",
    //   "url": "{{ url('buyer/request/order') }}",
    //   "data": {
    //     "_token": "{{ csrf_token() }}",
    //     offer_id: offer_id,
    //     request_id: request_id
    //   },
    //   "success": function(data) {
    //     // console.log(data);
    //     // window.location.href = "{{ url('transaction/payment/new') }}";
    //   },
    //   "error": function(error) {
    //     console.log(error);
    //   }
    // });

  }
</script>
@endsection
