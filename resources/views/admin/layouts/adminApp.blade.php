<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{globalSetting('siteName')}} | admin </title>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Codedthemes" />
	<!-- Favicon icon --> 
    @if(!empty(globalSetting('siteFavicon')))   
	    <link rel="icon" href="{{ URL::asset('/uploads/'.globalSetting('siteFavicon')) }}" type="image/x-icon">
    @endif
	<!-- vendor css -->
	<link rel="stylesheet" href="{{ asset('adminPanel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('adminPanel/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('adminPanel/assets/css/jquery.fancybox.min.css') }}" media="screen">
</head>
    <body class="">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        @include('admin.layouts.sidebar')
        @include('admin.layouts.header')
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                @yield('content')
            </div>
        </div>
        
    <script src="{{ asset('adminPanel/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/waves.min.js') }}"></script> 
    <script src="{{ asset('adminPanel/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/pages/dashboard-main.js') }}"></script>    
    <script src="{{ asset('adminPanel/assets/js/jquery.fancybox.min.js') }}"></script>
    <script>
        $(function() {   
            setTimeout(function() {
                $(".message").text('');
                $(".message").hide();
            }, 5000);
        });
        $(document).ready(function () { 
            $(".numberonly").on("input", function(evt) {
                var self = $(this);
                self.val(self.val().replace(/[^0-9]/g, ''));
                if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
                {
                    evt.preventDefault();
                }
            });          

            $(".allow_number_decimal").on("input", function(evt) {
                var self = $(this);
                self.val(self.val().replace(/[^0-9\.]/g, ''));
                if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
                {
                    $('.number_decimal').text('Enter numbers with decimal.'); 
                    evt.preventDefault();
                }
            });
        });
        $( function() {
            $("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' })
        }); 

        $(document).ready(function(){
            $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none"
            });
                
            $(".zoom").hover(function(){
                $(this).addClass('transition');
            }, function(){                    
                $(this).removeClass('transition');
            });
        });
        
    </script>
    <script src="{{ asset('adminPanel/assets/js/jquery-ui.js') }}"></script> 
    @stack('scripts')
</body>
</html>
