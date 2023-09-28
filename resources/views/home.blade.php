<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                @if (! auth()->user()->two_factor_secret)
                you have not enable 2fa
                
                <form method="POST" action="{{url('user/two-factor-authentication')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Enable</button>
                </form>
                @else
                you have enable 2fa

                <form method="POST" action="{{url('user/two-factor-authentication')}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Disable</button>
                </form>
                @endif

                    </div>

                    <div class="col-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @php
                            dd(auth()->user());
                        @endphp
                    </div>
                </div>

                

                @if (session('status')=='two-factor-authentication-enabled')
                    you have now enable 2fa, please scan the QR code into your phone authenticator application.
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}

                    <p>please store these recovery code in a secure location.</p>
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code )
                        {{ trim($code)}} <br>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>