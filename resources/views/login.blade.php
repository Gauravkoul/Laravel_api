<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="icon" href="{{ asset('logotop.png') }}">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('app.css') }}" > 
    <script  type="text/javascript" src="{{ asset('app.js') }}" defer> </script>

    <script  src="{{asset('ajax.js') }}" defer></script>
   
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}" > 
    <script  type="text/javascript" src="{{ asset('bootstrap.bundle.min.js') }}" defer> </script>
    <link rel="stylesheet" href="{{ asset('font-awesome.min.css') }}" > 
   
    <script  type="text/javascript" src="{{ asset('jquery.min.js') }}" > </script>
    <title>Login</title>
    </head>

<body>


@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class=" card0 border-0">
	@if ( session()->get('error_message')  )
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error:  {{ session()->get('error_message') }}
					<button type="button" class="close cl" data-dismiss="alert" aria-label="Close">
              			<span aria-hidden="true">&times;</span>
          			</button>
				</div>
	@elseif(session()->get('success_message'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">	
					<strong> {{ session()->get('success_message') }}
					<button type="button" class="close cl" data-dismiss="alert" aria-label="Close">
              			<span aria-hidden="true">&times;</span>
          			</button>
				</div>
	@endif
        <div class="row d-flex main transparent">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 py-5 justify-content-center mt-5 mb-5 border-line"><img src="{{ asset('logo.png') }}"class="image" />  </div>
                </div>
            </div>
			<div class="col-md-6 px-3 mt-5">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row" style="word-spacing:50px">
							<div class="col-xs-6">
								<a href="#" class="active pl-5 ml-5" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">&nbsp;&nbsp;&nbsp;&nbsp;SignUp</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12 mt-5">
								<form id="login-form" action="{{ url('login/update') }}" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text"  name="email"  placeholder="Enter a valid email address OR Phone Number" id="email" tabindex="1" class="form-control transparent"  required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password"   tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 offset-sm-3">
                                            <button type="submit" id="button" class="btn btn-primary text-center col-md-12" ><h6>Login </h6> </button>
										
                                        </div>
										</div>
									</div>
								</form>
								<form id="register-form" action="{{ url('signup') }}" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="Username" required>
									</div>
									<div class="form-group">
										<input type="tel" name="email" id="email" tabindex="1" class="form-control" placeholder="Enter a valid email address OR Phone Number" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="c_password" id="password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 offset-sm-3">
                                                <button type="submit" class="btn btn-success text-center col-md-12"><h6>SignUp </h6></button> </div>
											</div>
										</div>
									</div>
								</form>
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class=" mt-3">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mt-0 text-white"><h5>Developer:- Gaurav koul </h5></small>
            </div>
        </div>
    </div>
</div>
</body>
</html>