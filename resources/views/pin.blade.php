<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enter Pin</title>
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
            <h5 class="card-title">Payment of ${{ $fee->amount }}, Enter Pin To Confirm!</h5>
            <form action="{{ route('pin') }}" method="POST">
                @csrf
                <input type="hidden" name="balance" value="{{ $account->balance }}" required>
                <input type="hidden" name="amount" value="{{ $fee->amount }}" required>
                <input type="hidden" name="user_id" value="{{ $account->id }}" required>
                <input type="number" name="pin" placeholder="Enter Pin" class="form-control form-control-sm mb-5"  autofocus required>
                <button type="button" class="btn btn-success">Authorize</button>
            </form>

        </div>
        <div id="time" class="card-footer text-muted">
          load time...
        </div>
    </div>
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
