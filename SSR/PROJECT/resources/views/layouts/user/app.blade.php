<!DOCTYPE html>
<html lang="en">
    @include('layouts.user.components.header')
    <body>

        @include('layouts.user.components.menu')

        @yield('content')

        @include('layouts.user.components.footer')

        @include('layouts.user.components.scripts')
    </body>
    @yield('customjs')
    <script>
        function goSearch(event){
            var searchBar = "?search=" + $("#searchBar").val();
            alert('masuk')''
            // window.location.href = 'jasa/' + searchBar;
        }
    </script>
</html>
