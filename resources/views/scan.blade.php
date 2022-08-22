<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>scan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ asset('assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="card text-center m-5">
        <div class="card-header">
            RFID Tolgate Scanner
        </div>
        <div class="card-body">
            <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ Session::get('success') }}
                </div>
            @endif
            <h5 class="card-title">Do not touch, just Swipe!</h5>
            <form id="myform" action="{{ route('scanner') }}" method="POST">
                @csrf
                <input class="form-control mb-5" type="text" id="rfid" name="rfid" placeholder="rfid" autofocus>
                <button type="button" id="submit" class="btn btn-primary">Scan Card</button><br>
                <a href="{{ route('admin-dashboard') }}" >Return Home</a>
            </form>

        </div>
        <div id="time" class="card-footer text-muted">
          load time...
        </div>
    </div>

    <script>
        $('#rfid').change(function() {
            var dInput = this.value;

            // submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#submit').html('Please Wait...');
                $("#submit"). attr("disabled", true);
                $.ajax({
                    url: "{{route('scanner')}}",
                    type: "POST",
                    data: $('#myform').serialize(),
                    success: function( response ) {
                        $('#submit').html('Submit');
                        $("#submit"). attr("disabled", false);
                        //console.log(response);
                        document.getElementById("myform").reset();
                    }
                });
            // }
            // var $this = $('#myform'); //alias form reference

            // $.ajax({ //2
            //     url: $this.prop('action'),
            //     method: $this.prop('method'),
            //     dataType: 'json',  //3
            //     data: $this.serialize() //4
            // }).done( function (response) {
            //     if (response.hasOwnProperty('status')) {
            //         $('#target-div').html(response.status); //5
            //     }
            // });
        });




    </script>
    <Script>
        var timeDisplay = document.getElementById("time");


        function refreshTime() {
        var dateString = new Date().toLocaleString("en-US", {timeZone: "Africa/Harare"});
        var formattedString = dateString.replace(", ", " - ");
        timeDisplay.innerHTML = formattedString;
        }

        setInterval(refreshTime, 1000);
    </Script>
</body>
</html>
