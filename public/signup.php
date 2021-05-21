<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css"> 
    <link rel="stylesheet" href="bootstrap.min.css"> 
    <script src="bootstrap.bundle.min.js"> </script>
    <link rel="stylesheet" href="font-awesome.min.css"> 
    <script src="jquery.min.js"> </script>
    <title>Document</title>
    </head>

<body>
    <!-- <form action="{{ url('user/login') }}" method="post">
        @csrf
        <div class="form-group formIn col-md-12 ">
            <i class="fa fa-user fa-lg icon icons"  style=""></i><input type="text"  name="email" required placeholder=" Enter your Email/Phone" class="form-control  col-md-12 col-sm-11 col-10 enter"/> <br>
            <i class="fa fa-key icon icons"></i><input type="password" name="password" required placeholder="Enter your Password" class="form-control  col-md-12 col-sm-11 col-10 enter" ><br>
            <button  type="submit" class=" buttons col-md-10 col-sm-9 col-8">LOGIN</button> </div>
        </div>
    </form>   
</body>
</html>  -->
<div class="nav ">

</div>
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                   
                    <div class="row px-3 py-5 justify-content-center mt-5 mb-5 border-line"><img src="logo.png"class="image" />  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                <div class="row px-3 mt-5"> <label class="mb-1">
                        <h6 class="mb-0 text-sm">Name</h6>
                        </label> <input class="mb-4" type="text" name="name" placeholder="Enter your name"> </div>
                    <div class="row px-3 "> <label class="mb-1">
                        <h6 class="mb-0 text-sm">Email Address/Phone Number</h6>
                        </label> <input class="mb-4" type="text" name="email"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="Enter a valid email address OR Phone Number" ></div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                        </label> <input type="password" name="password" placeholder="Enter password"> </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                    </div>
                    <div class="row mb-3 px-3 "> <button type="submit" class="btn btn-primary text-center col-md-12"><h5>SignUp </h5></button> </div>
                
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Developer:- Gaurav koul</small>
                <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>