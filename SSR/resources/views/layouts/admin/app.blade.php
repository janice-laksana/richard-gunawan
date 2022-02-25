<!DOCTYPE html>
<html lang="en">
    @include('layouts.admin.components.header')
    <body class="animsition">
        <div class="page-wrapper">
        @include('layouts.admin.components.sidebar')

        <div class="page-container">

        @include('layouts.admin.components.menu')

        @yield('content')

        </div>

        @include('layouts.admin.components.scripts')
        </div>
    </body>
    @yield('customjs')
</html>
