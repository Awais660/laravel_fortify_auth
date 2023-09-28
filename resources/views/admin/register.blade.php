<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
        </style>
</head>
<body>
    
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                      </div>
      
                      <form method="POST" action="{{route('admin.register')}}">
                        @csrf
                        <p>Please register for new account</p>
      
                        <div class="form-outline mb-4">
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                    <strong>{{$message}}</strong>
                            </div>
                            @enderror
                            <input type="text" id="form2Example11" name="name" class="form-control"
                              placeholder="Name" />
                            <label class="form-label" for="form2Example11">Name</label>
                          </div>

                        <div class="form-outline mb-4">
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                                    <strong>{{$message}}</strong>
                            </div>
                            @enderror
                          <input type="email" id="form2Example11" name="email" class="form-control"
                            placeholder="Email address" />
                          <label class="form-label" for="form2Example11">Username</label>
                        </div>
      
                        <div class="form-outline mb-4">
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                    <strong>{{$message}}</strong>
                            </div>
                            @enderror
                          <input type="password" id="form2Example22" name="password" class="form-control" />
                          <label class="form-label" for="form2Example22">Password</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example22" name="password_confirmation" class="form-control" />
                            <label class="form-label" for="form2Example22">Confirm Password</label>
                          </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                          <a class="text-muted" href="#!">Forgot password?</a>
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2">Have an account?</p>
                          <button type="button" class="btn btn-outline-danger">Login</button>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">We are more than just a company</h4>
                      <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>