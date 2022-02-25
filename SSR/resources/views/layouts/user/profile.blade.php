<!DOCTYPE html>
<html lang="en">
    @include('layouts.user.components.header')
    <body>

        <!--================Home Left Menu Area =================-->
        <div class="home_left_main_area">
            @include('layouts.user.components.profile_left')
            @yield('content')
        </div>
        <!--================End Home Left Menu Area =================-->

        @include('layouts.user.components.scripts')
        @yield('customjs')
    </body>
</html>
