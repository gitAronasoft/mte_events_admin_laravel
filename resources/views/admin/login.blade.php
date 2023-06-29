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
	    <link rel="icon" href="{{globalSetting('siteFavicon')}}" type="image/x-icon">
    @endif
	<!-- vendor css -->
	<link rel="stylesheet" href="{{ asset('adminPanel/assets/css/style.css') }}">
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
                        @if(!empty(globalSetting('siteLogo')))
						    <img src="{{globalSetting('siteLogo')}}" alt="" class="img-fluid mb-4">
                        @else 
                            <h4>{{globalSetting('siteName')}}</h5>                            
                        @endif
                        <hr>
						<h4 class="mb-3 f-w-400">Admin Login</h4>
                        <div class="message">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                </div>
                            @endif
                        </div>
                        {{ Form::open(array('url' => 'admin')) }}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <input type="text" name="email" value="" class="form-control" placeholder="Email address">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <input type="password" name="password" value="" class="form-control" placeholder="Password">
                            </div>						
						    <button class="btn btn-block btn-primary mb-4">Signin</button>
                        {{ Form::close() }}
						<p class="mb-2 text-muted">Forgot password? <a href="#" class="f-w-400">Reset</a></p>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- [ auth-signin ] end -->
    <!-- Required Js -->
    <script src="{{ asset('adminPanel/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminPanel/assets/js/waves.min.js') }}"></script>
    <script>
        $(function() {   
            setTimeout(function() {
                $(".message").text('');
                $(".message").hide();
            }, 5000);
        });
    </script>
</body>
</html>
