    <!-- Jquery JS-->
    <script src="{{ asset('vendors/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendors/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendors/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('vendors/wow/wow.min.js') }}"></script>
    <script src="{{ asset('vendors/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('vendors/counterup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendors/counterup/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('vendors/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendors/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('js/admin-main.js') }}"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {
            $('#daterange').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                datestart = start.format('YYYY-MM-DD').toString().replace(/-/g,"");
                dateend = end.format('YYYY-MM-DD').toString().replace(/-/g,"");

                var value = {
                    "_token": "{{ csrf_token() }}",
                    datestart: datestart,
                    dateend: dateend
                }
                $.ajax({
                    type: "POST",
                    url: '/admin/gettrans',
                    data: value,
                    dataType: 'JSON',
                    cache: false,
                    success:
                        function(data){
                            var str = '';
                            $.each(data, function (index, value) {
                                str+='<tr>';
                                str+='<td>'+value.created_at+'</td><td>'+value.jasa_id+'</td><td class="text-right">'+ value.transaksi_price +'</td><td class="text-right">'+value.transaksi_seller_id+'</td><td class="text-right">'+value.transaksi_buyer_id+'</td>';
                                str+='</tr>';
                            });
                            $('#trans_container').html(str);
                        }
                });

                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
