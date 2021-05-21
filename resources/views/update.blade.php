<?php
  error_reporting(0);
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="icon" href="{{ asset('logotop.png') }}">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('update.css') }}" > 
    <script  type="text/javascript" src="{{ asset('app.js') }}" defer> </script>
    <script  src="{{asset('ajax.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}" > 
    <script  type="text/javascript" src="{{ asset('bootstrap.bundle.min.js') }}"  defer > </script>
    <link rel="stylesheet" href="{{ asset('font-awesome.min.css') }}" > 
    <script  type="text/javascript" src="{{ asset('jquery.min.js') }}" > </script>
  <title>Update</title>
  </head>
  <body>
  @section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-5">
        @if ( $error_message  )
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error:  {{ $error_message }}
					<button type="button" class="close cl" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
				</div>
        @elseif( $success_message )
            <div class="alert alert-success alert-dismissible fade show" role="alert">	
                  <strong> {{ $success_message }}
                  <button type="button" class="close cl" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
      	@endif
         
          <div class="card-signin ">
            <div class="card-body">
              <h5 class="card-title text-center font-weight-bold">Update Profile</h5>
              <form class="form-signin" action="{{ url('update')}}" method="post">
                <div class="form-label-group">
                    <input type="text" id="inputEmail" name="name" class="form-control " placeholder="Enter your name" >
                    
                  </div>
                <div class="form-label-group">
                  <input type="text" id="inputEmail" name="email" class="form-control " placeholder="Enter a valid email address OR Phone Number" >
                  
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" >
                 
                </div>
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="c_password" class="form-control" placeholder="Confirm Password" >
                </div>
                <button   class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"><h6> Update </h6></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </body>
</html>
