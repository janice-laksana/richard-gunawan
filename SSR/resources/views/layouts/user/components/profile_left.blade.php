<div class="left_menu">
    <div class="offcanvas_fixed_menu">

        <a class="logo_offcanvas" href="#"><img src="{{ asset('img/logo-white.png') }}" alt=""></a>
        {{-- <div class="input-group search_form">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button"><i class="icon-magnifier icons"></i></button>
            </span>
        </div> --}}
        <p class="nav-item text-center" style="color: whitesmoke;">Your wallet : IDR {{ number_format(Auth::user()->user_balance ?? 0) }}</p>
        <div class="offcanvas_menu">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/profile') }}">Profile</a></li>
                <li class="dropdown side_menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transaction <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ url('buyer/transaction') }}">Your transaciton</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('buyer/request') }}">Your request</a></li>
                    </ul>
                </li>
                <li class="dropdown side_menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Seller <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ url('seller/transaction') }}">Incoming transaciton</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('seller/offer') }}">Your offer</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{url('/wishlist/')}}">Wishlist</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">History</a></li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
        {{-- <div class="cart_list">
            <ul>
                <li class="cart_icon"><a href="#"><i class="icon-handbag icons"></i></a></li>
                <li class="h_price">
                    <select class="selectpicker">
                        <option>$0.00</option>
                        <option>$0.00</option>
                        <option>$0.00</option>
                    </select>
                </li>
            </ul>
        </div> --}}
    </div>
</div>
