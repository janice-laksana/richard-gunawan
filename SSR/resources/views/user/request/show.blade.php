@extends('layouts.user.app')

@section('content')
<!--================Contact Area =================-->
<section class="contact_area p_100">
    <div class="container">
      <div class="contact_title">
        <h4>Description :</h4>
        <p>{{ $request->request_description }}</p>
        <h6>Perkiraan Waktu : {{ $request->jasa_time }} Day(s)</h6>
        <h6>Anggaran : {{ number_format($request->request_budget) }}</h6>
      </div>
      <div class="row contact_details justify-content-center">
        {{-- <div class="col-lg-4 col-md-6">
          <div class="media">
            <div class="d-flex">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="media-body">
              <p>{{ $request->user->nationality_id ?? 'undefined' }}</p>
            </div>
          </div>
        </div> --}}
        <div class="col-lg-4 col-md-6">
          <div class="media">
            <div class="d-flex">
              <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
            <div class="media-body">
              <a href="tel:{{ $request->user->user_phone }}">{{ $request->user->user_phone ?? 'undefined' }}</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="media">
            <div class="d-flex">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </div>
            <div class="media-body">
              <a href="mailto:{{ $request->user->email }}">{{ $request->user->email ?? 'undefined' }}</a>
            </div>
          </div>
        </div>
      </div>
      <div class="contact_form_inner">
        <h3>Tinggalkan Pesan</h3>
        <form class="contact_us_form row" action="{{ url('request/add/') . '/' . $request->request_id }}" method="post">
          @csrf
          <div class="form-group col-lg-12">
            <select required class="form-control" id="jasa_id" name="jasa_id">
              <option value="" disabled selected>- Pilih Jasa -</option>
              @foreach ($list_jasa as $jasa)
              <option value="{{ $jasa->jasa_id }}">{{ $jasa->jasa_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-lg-6">
            <input required type="number" class="form-control" id="price" name="price" placeholder="Harga (IDR)" min="0">
          </div>
          <div class="form-group col-lg-6">
            <input required type="number" class="form-control" id="time" name="time" placeholder="Waktu Pengiriman (Day)" min="0">
          </div>
          <div class="form-group col-lg-12">
            <textarea required class="form-control" name="description" id="description" rows="1" placeholder="Isi Deskripsi ..."></textarea>
          </div>
          <div class="form-group col-lg-12">
            <button type="submit" value="submit" class="btn update_btn form-control">Kirim Penawaran</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!--================End Contact Area =================-->

@endsection
