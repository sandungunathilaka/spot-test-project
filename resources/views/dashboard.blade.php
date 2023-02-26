<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    <link  href="{{ asset('css/bootstrap.min.css') }}"  rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Place New Order</h3>
                    <div class="card-body">
                        <form action="#" id="servicesubmitformdsfds" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Customer Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Order Value" id="order_value" class="form-control" name="order_value"
                                    required autofocus>
                                @if ($errors->has('order_value'))
                                <span class="text-danger">{{ $errors->first('order_value') }}</span>
                                @endif
                            </div>

                          <div  class="col-md-12" id="respone"></div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

    @yield('content')
</body>
</html>
<meta name="csrf-token" content="{{ csrf_token() }}" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script type="text/javascript">


        $(function () {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#servicesubmitformdsfds').submit(function(e) {
                $('#respone').html('');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo route('save.order') ?>',
                  
                    data: {
                        name: $("#name" ).val(),
                        order_value: $("#order_value" ).val()
                    },
                  
                    success: function (data) {

                      if(data.result==false){

                       $('#respone').html('<p style="color: red;font-size: 15px;border: 3px solid red;text-align: center; margin-top:20px">Data not saved.</p>');

                      }else{
                         $('#respone').html('<p style="color: green;font-size: 15px;border: 3px solid green;text-align: center; margin-top:20px">Successfully submitted.</p>');


                                $.ajax({
                                type: 'POST',
                                url: 'https://wibip.free.beeceptor.com/order',

                                data: data.result,

                                success: function (data) {

                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                }

                                });     




                      }

                    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      $('#respone').html('<p style="color: red;font-size: 15px;border: 3px solid red;text-align: center; margin-top:20px">'+XMLHttpRequest.responseJSON.message+'</p>');
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }

                });

                  
            });







        });



    </script>