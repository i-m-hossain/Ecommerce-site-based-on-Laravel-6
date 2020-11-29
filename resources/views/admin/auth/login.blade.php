
@extends('admin.admin_layout')

@section('admin_content')

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
            <div class="tx-center mg-b-60">Professional Admin Template Design</div>
            <form action="{{route('admin.login')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Email">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                        @enderror
                    <a href="{{route('admin.password.request')}}" class="text-info text-12 d-block mg-t-10">I forgot my password</a>
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Sign In</button>

                <div class="mg-t-60 tx-center">Not yet a member? <a class="registration" href="{{ route('register')}}">Sign Up</a><br></div>

            </form>

        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection

