@extends('auth.layouts.app')

@section('content')
<!--begin::Content-->
<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
    <!--begin::Content body-->
    <div class="d-flex flex-column-fluid flex-center">
        <!--begin::Signin-->
        <div class="login-form login-signin">
            <!--begin::Form-->
            <form method="POST" action="{{ route('login') }}" class="form" novalidate="novalidate">
                @csrf
                <!--begin::Title-->
                <div class="pb-13 pt-lg-0 pt-5">
                    <h4 class="font-weight-bolder text-dark font-size-h4 font-size-h3-lg">Silahkan Login</h4>
                    {{-- <span class="text-muted font-weight-bold font-size-h4">New Here? --}}
                    {{-- <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span> --}}
                </div>
                <!--begin::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" placeholder="Masukkan Email Anda" autocomplete="off" autofocus/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <div class="d-flex justify-content-between mt-n5">
                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                        {{-- <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Lupa Password ?</a> --}}
                    </div>
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Masukkan Password Anda" autocomplete="off" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Form group-->
                <!--begin::Action-->
                <div class="pb-lg-0 pb-5">
                    <center>
                    <button type="submit" class="btn btn-danger font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
                </center>
                    {{-- <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/social-icons/google.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z" fill="#4285F4" />
                            <path d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z" fill="#34A853" />
                            <path d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z" fill="#FBBC05" />
                            <path d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z" fill="#EB4335" />
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Sign in with Google</button> --}}
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
        <!--begin::Signup-->
        <div class="login-form login-signup">
            <!--begin::Form-->
            <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                <!--begin::Title-->
                <div class="pb-13 pt-lg-0 pt-5">
                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                    <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <label class="checkbox mb-0">
                        <input type="checkbox" name="agree" />
                        <span></span>
                        <div class="ml-2">I Agree the
                        <a href="#">terms and conditions</a>.</div>
                    </label>
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                    <button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                    <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                </div>
                <!--end::Form group-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signup-->
        <!--begin::Forgot-->
        <div class="login-form login-forgot">
            <!--begin::Form-->
            <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                <!--begin::Title-->
                <div class="pb-13 pt-lg-0 pt-5">
                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                    <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group d-flex flex-wrap pb-lg-0">
                    <button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                    <button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                </div>
                <!--end::Form group-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Forgot-->
    </div>
    <!--end::Content body-->
    <!--begin::Content footer-->
    <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
        <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
            <span class="mr-1"><?=date('Y')?> ©</span>
            <a href="{{url('/')}}" target="_blank" class="text-dark-75 text-hover-primary">Sistem Pendukung Keputusan SAW</a>
        </div>
        {{-- <a href="#" class="text-primary font-weight-bolder font-size-lg">Terms</a>
        <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
        <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a> --}}
    </div>
    <!--end::Content footer-->
</div>
<!--end::Content-->

@endsection
