<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | Tolgate-App</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="{{ asset('assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-form">
                            <div class="login-logo">
                                <a href="/">
                                    <span>
                                        <img src="{{ asset('assets/images/ZINARA_W-removebg-preview.png') }}">
                                    </span>
                                </a>
                            </div>
                            <h4>Tolgate App Register</h4>
                            <x-auth-validation-errors class="alert alert-danger" role="alert" :errors="$errors" />
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="regnum" class="form-control" placeholder="Vehicle Regnum" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="vname" class="form-control" placeholder="Vehicle Name" required>
                                </div>
                                <div class="form-group">
                                    <select name="vclass" class="form-control" required>
                                        <option selected disabled>Select Tolgate Class</option>
                                        <option value="1">Motor Cycles</option>
                                        <option value="2">Light Motor Vehicles</option>
                                        <option value="3">Minibuses</option>
                                        <option value="4">Buses</option>
                                        <option value="5">Heavy Vehicles</option>
                                        <option value="6">Haulage Trucks</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" required class="form-control" placeholder="Confirm Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                <div class="register-link m-t-15 text-center">
                                    <p>Already have account ? <a href="{{ route('login') }}"> Login Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

