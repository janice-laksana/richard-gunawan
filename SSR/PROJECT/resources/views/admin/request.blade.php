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
                                        <option selected="selected">All Properties</option>
                                        <option value="">Products</option>
                                        <option value="">Services</option>
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
                                            <th>owner</th>
                                            <th>description</th>
                                            <th>kategori</th>
                                            <th>time</th>
                                            <th>status</th>
                                            <th>budget</th>
                                            <th>create at</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr class="tr-shadow">
                                                <td>
                                                    <span class="block-email">{{ $item->user->name }}</span>
                                                </td>
                                                <td>{{ $item->request_description }}</td>
                                                <td>{{ $item->category->category_name }}</td>
                                                <td>{{ $item->jasa_time }} Day</td>
                                                <td>
                                                    <span class="status--process">
                                                        @if ($item->request_status == 0)
                                                            <span class="status--pending">
                                                                Pending
                                                            </span>
                                                        @elseif($item->request_status == 1)
                                                            <span class="status--process">
                                                                Active
                                                            </span>
                                                        @elseif($item->request_status == 2)
                                                            <span class="status--process">
                                                                Accepted
                                                            </span>
                                                        @elseif($item->request_status == 3)
                                                        <span class="status--denied">
                                                        Unapproved
                                                            </span>
                                                            
                                                        @elseif($item->request_status == 4)
                                                            Revision
                                                        @elseif($item->request_status == 5)
                                                            Finished
                                                        @elseif($item->request_status == 6)
                                                        <span class="status--denied">
                                                        Canceled
                                                            </span>
                                                            
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>Rp. {{ number_format($item->request_budget) }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if ($item->request_status == 0)
                                                        <a class="btn btn-primary" href="{{ url('admin/actionrequest/'.$item->request_id.'/1') }}" role="button">Accept</a> <a class="btn btn-danger" href="{{ url('admin/actionrequest/'.$item->request_id.'/-1') }}" role="button">Reject</a>
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
@endsection
