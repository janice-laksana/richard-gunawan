@extends('layouts.admin.app')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- USER DATA-->
                        <div class="user-data m-b-30">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-account-calendar"></i>{{ $title }}</h3>
                            <!-- <div class="filters m-b-45">
                                <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">All</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Accepted</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                    <select class="js-select2 au-select-dark" name="time">
                                        <option selected="selected">All Time</option>
                                        <option value="">By Month</option>
                                        <option value="">By Day</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div> -->
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>owner</th>
                                            <th>image</th>
                                            <th>price</th>
                                            <th>status</th>
                                            <th>created at</th>
                                            <th>action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr class="tr-shadow">
                                                <td>{{ $item->jasa_name }}</td>
                                                <td>
                                                    <span class="block-email">{{ $item->user->name }}</span>
                                                </td>
                                                <td><button type="button" class="btn btn-link">{{ $item->jasa_img }}</button></td>
                                                <td>Rp. {{ number_format($item->jasa_price) }}</td>
                                                <td>
                                                        @if ($item->jasa_status == 0)
                                                            <span class="status--pending">
                                                                Pending
                                                            </span>
                                                        @elseif($item->jasa_status == 1)
                                                            <span class="status--process">
                                                                Accepted
                                                            </span>
                                                        @elseif($item->jasa_status == 2)
                                                            <span class="status--denied">
                                                                Rejected
                                                            </span>
                                                        @endif
                                                </td>
                                                <td>{{ $item->jasa_publish_date }}</td>
                                                <td>
                                                    @if ($item->jasa_status == 0)
                                                        <a class="btn btn-primary" href="{{ url('admin/actionjasa/'.$item->jasa_id.'/1') }}" role="button">Accept</a> <a class="btn btn-danger" href="{{ url('admin/actionjasa/'.$item->jasa_id.'/-1') }}" role="button">Reject</a>
                                                    @else
                                                        <a class="btn btn-warning" href="#" role="button">DONE</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @empty
                                            <h3>Kosong</h3>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="user-data__footer">
                                <button class="au-btn au-btn-load">load more</button>
                            </div>
                        </div>
                        <!-- END USER DATA-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var filter="";
        var page=1;
        function update_ajax(filter="", page=1) {
            var value = {
                "_token": "{{ csrf_token() }}",
                receiver: tujuan,
                message: $("#message-to-send").val()
            }
            $.ajax({
                type: "POST",
                url: '/chat/send',
                data: value,
                dataType: 'JSON',
                cache: false,
                success:
                    function(data){
                    alert(data);
                }
            });
        }

    </script>
@endsection
