
<!doctype html>
<html lang="en">
  <head>
  	<title>TMC | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="{{ asset('uploads/tmc-logo.png') }} ">
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet"> -->

	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	
	<link rel="stylesheet" href="{{ asset('login-assets/css/style.css')  }}">
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
	<link rel="stylesheet" href="{{ asset('preloader/css/normalize.css')  }}">
	<link rel="stylesheet" href="{{ asset('preloader/css/main.css')  }}">
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
	<script src="{{ asset('preloader/js/vendor/modernizr-2.6.2.min.js')  }}"></script>
	

	</head>
	<body class="img js-fullheight" style="background-image: url({{ asset('login-assets/images/login-bg.jpg') }});">
	
	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center" style="margin-right: 10px; margin-left: 10px;">
				<div class="col-md-6 col-lg-4"  style="background-color: rgba(0, 0, 0,0.20); backdrop-filter: blur(9px);border-radius: 10px;">
					<div class="login-wrap p-0" >
		      	<h3 class="mb-4 text-center"><strong >TMC<br>Online Clearance</strong></h3>
		      	<form method="POST" id="loginForm" action="{{ route('Login.login2') }}">
                @csrf
		      		<div class="form-group">
                      <input id="email" type="email" class="form-control @if (session('err_email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email (sample@gmail.com)">
					  <span class="invalid-feedback" id="name" role="alert">
                        	<strong>* Input email doesn't exist!</strong>
                        </span>
		      		</div>
	            <div class="form-group">
                <input id="password-field" type="password" class="form-control @if (session('err_pass')) is-invalid @endif" name="password" required autocomplete="current-password" placeholder="Password">
                    <span toggle="#password-field" class="field-icon toggle-password fa fa-fw fa-eye-slash try"> </span>
						<span class="invalid-feedback" id="name" role="alert">
                        	<strong>* Input password is wrong!</strong>
                        </span>
               
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">{{ __('Remember Me') }}
							<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
							<span class="checkmark"></span>
						</label>
					</div>
								
	            </div>

                
	          </form>
	          
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('login-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login-assets/js/popper.js') }}"></script>
    <script src="{{ asset('login-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-assets/js/main.js') }}"></script>
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

	<script src="{{ asset('preloader/js/main.js') }}"></script>
	<script src="{{ asset('plugins/loader.js') }}"></script>
	<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
   <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
	<script>
	

	$('.try').attr('hidden','hidden');
	 $(function () {
		var err_user = "";
		var err_pass = "";

      $(document).keyup(function (e) {
        //  console.log(e.keyCode);
		
		var eye = $('#password-field').val();
		var emil_eye = $('#email').val();
		if(eye !==''){

			$('.try').removeAttr('hidden','hidden');
			
			if(err_pass == "true"){
				$('.try').attr('style','padding-bottom: 27px;');
			}
			else{
				$('.try').removeAttr('style','padding-bottom: 27px;');
			}
			
		}else{
			
			$('.try').attr('hidden','hidden');
			
		}
		
      });

	  $('#loginForm').on('submit',function(e){
			e.preventDefault();
			start_load();
			$.ajax({
				type     : "POST",
				cache    : false,
				url      : $(this).attr('action'),
				data     : $(this).serialize(),
				success  : function(data) {
					if(data == "falsepass"){
						
						$('#password-field').addClass('is-invalid');
						$('#email').removeClass('is-invalid');
						$('#password-field').val("");
						$('.try').attr('hidden','hidden');
						err_pass = "true";
						$('#text').html('Wrong pass');
						end_load();

					}else if(data == "falseuser"){
						$('#password-field').removeClass('is-invalid');
						$('.try').removeAttr('style');
						$('#email').addClass('is-invalid');
						err_pass = "";
						end_load();
					}else{

						toastr.success('Success user login');
						if (data.result == 3) {
							setTimeout(()=>{
								location.href = "/Student-Dash"
							},1500);
						}else{
							setTimeout(()=>{
								location.reload();
							},1500);
						}
						
					}
				}
			});

		});
		function name(params) {
			var nm = params;
		}
    });
	
	</script>
	</body>
</html>

