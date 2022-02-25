@extends('layouts.user.profile')

@section('content')

<div class="right_body">
    <div class="latest_product_3steps">
      <div class="s_m_title">
        <div class="c_main_title">
          <h2 style="font-size: 3rem;">Your Custom Offer</h2>
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
                <div class="billing_details">
                <h2 class="reg_title">Jasa Apa yang Anda Cari?</h2>
                <form class="billing_inner row" method="post" action="{{ url('seller/offer/add') }}">
                    @csrf
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="font-weight-bold" for="desc">Jelaskan pesan yang ingin Anda kirim - diharapkan sedetail mungkin: <span>*</span></label>
                            <textarea name="description" class="form-control" id="desc" rows="3" placeholder="Jelaskan pesan yang ingin Anda kirim - diharapkan sedetail mungkin" required minlength="10"></textarea>
                        </div>
                    <hr>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="form-group">
                            <label for="category_id">Kategori <span>*</span></label>
                            <select class="selectpicker" id="category_id" name="category_id" required>
                            <option value="" selected disabled hidden>- Pilih... -</option>
                                @foreach ($list_category as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label for="jasa_time">Berapa lama jasa Anda dikirim?<span>*</span></label>
                            <select class="selectpicker" id="jasa_time" name="jasa_time" onchange="openDialog()" required>
                                <option value="" selected disabled hidden>- Pilih... -</option>
                                <option value="1">24 Jam</option>
                                <option value="3">3 Hari</option>
                                <option value="7">7 Hari</option>
                                <option value="other">Lainnya</option>
                            </select>
                    </div>
                    </div>
                    <div class="col-lg-12" id="formTime">
                    <div class="form-group">
                        <label for="time">time<span>*</span></label>
                        <input disabled type="number" class="form-control" id="time" aria-describedby="time" placeholder="eg : 30 Days ..." name="time" min="0">
                    </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label for="budget">Budget (IDR) <span>*</span></label>
                        <input type="number" class="form-control" id="budget" aria-describedby="budget" placeholder="" name="budget" min="0" required>
                    </div>
                    </div>
                    <div class="col-lg-2 form-group">
                    <button type="submit" value="submit" class="btn subs_btn form-control">Post</button>
                    </div>
                </form>
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
    function openDialog() {
        if ($('#jasa_time').val() == 'other') {
            $('#time').removeAttr('disabled');
            $('#formTime').fadeIn();
        } else {
            $('#time').attr('disabled', '');
            $('#formTime').fadeOut();
        }
    }

    $(document).ready(() => {
        $('#time').attr('disabled', '');
        $('#formTime').hide();
    });
  </script>
@endsection
