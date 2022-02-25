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
                                        <option value="">Pending</option>
                                        <option value="">Accepted</option>
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
                                            <th>username</th>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>role</th>
                                            <th>status</th>
                                            <th>balance</th>
                                            <!-- <th>action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr class="tr-shadow">
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <span class="block-email">{{ $item->email }}</span>
                                                </td>
                                                <td>{{ $item->user_phone }}</td>
                                                <td>
                                                    @if ($item->is_vendor == 0)
                                                        User
                                                    @elseif($item->is_vendor == 1)
                                                        Vendor
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="status--process">
                                                    @if ($item->user_is_active == 1)
                                                        Active
                                                    @else
                                                        Pending
                                                    @endif
                                                    </span>
                                                </td>
                                                <td>Rp. {{ number_format($item->user_balance) }}</td>
                                                <!-- <td>
                                                    <a class="btn btn-warning" href="{{ url('admin/actionuser/'.$item->id) }}" role="button">Detail</a>
                                                </td> -->
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
@endsection
