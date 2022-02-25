@forelse ($list_request as $request)
  <div class="c_product_item">
    <div class="row">
      <div class="col-12">
        <div class="c_product_text">
          <h4>Requester : {{ $request->user->name }}</h4>
          <h5>Rp. {{ number_format($request->request_budget) }}</h5>
          <!-- <h6>Available In <span>Stock</span></h6> -->
          <p>{{ $request->request_description }}</p>
          <ul class="c_product_btn">
            <li><a class="add_cart_btn" href="{{ url('request/' . $request->request_id) }}">Berikan Tawaran</a></li>
            {{-- <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>
@empty
<div class="row justify-content-center">
  <p>TIDAK ADA DATA DITEMUKAN</p>
</div>
@endforelse