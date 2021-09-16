@extends('frontend.layouts.auth_layout')

@section('content')

    <body id="register_bg">

    <nav id="menu" class="fake_menu"></nav>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div>
    <!-- End Preload -->

    <div id="login">
        <aside>
            <figure>
                <a href="/home"><img src="/frontend/img//logo_sticky.png" width="155" height="36" data-retina="true" alt="" class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @foreach($errors->all() as $error)
                    {{ $error  }}
                @endforeach
                <div class="form-group">
                    <label>Your Name</label>
                    <input class="form-control" type="text" id="exampleFirstName" name="name" value="{{ old('name') }}">
                    <i class="ti-user"></i>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="form-group">
                    <label>Your Last Name</label>
                    <input class="form-control" type="text" id="exampleLastName" name="lastname" value="{{ old('lastname') }}">
                    <i class="ti-user"></i>
                </div>

                <div class="form-group">
                    <label>Your Email</label>
                    <input class="form-control" type="email" id="exampleInputEmail-2" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                    <i class="icon_mail_alt"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="form-group">
                    <label>Telephone</label>
                    <input class="form-control" type="yexy" id="exampleInputEmail-2"  name="telephone" value="{{ old('telephone') }}">
                    <i class="icon-phone"></i>
                </div>
                <div class="form-group">
                    <label>Your password</label>
                    <input class="form-control" type="password" id="examplePasswordInput"  name="password" required autocomplete="new-password">
                    <i class="icon_lock_alt"></i>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="form-group">
                    <label>Confirm password</label>
                    <input class="form-control" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
                    <i class="icon_lock_alt"></i>
                </div>
                <div id="pass-info" class="clearfix"></div>
                <button class="btn_1 rounded full-width add_top_30" type="submit" style="
                                background: #f85959;border-color: rgb(255, 255, 255);border-top-color: rgb(255,;border-right-color: 255,;border-bottom-color: 255);border-left-color: 255,;"> Register Now!</button>
                <div class="text-center add_top_10">Already have an acccount? <strong><a href="/login">Sign In</a></strong></div>
            </form>
            <div class="copy">Créé par Hanane Jabou</div>
        </aside>
    </div>
    <!-- /login -->

    <!-- COMMON SCRIPTS -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/common_scripts.js"></script>
    <script src="js/main.js"></script>
    <script src="assets/validate.js"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="js/pw_strenght.js"></script>



    </body>

@endsection
