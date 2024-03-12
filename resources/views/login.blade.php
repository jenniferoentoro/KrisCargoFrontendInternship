@extends('layouts.app-login')

@section('title')
<title>Login</title>
@endsection
@section('style')
{{-- public login.css file --}}
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
<style>




</style>
@endsection
@section('content')
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
  
                  <div class="text-center">
                    <img src="images/logo-clean.png"
                      style="width: 300px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">We are The Kris Cargo Team</h4>
                  </div>
                  {{-- named route action login --}}
                  <form class="form-wrap" method="POST" action="{{ route('auth.front.login') }}" >
                    @csrf
                    <p>Please login to your account</p>
  
                    <div class="input_wrap mb-4">
                      <input id="input-email" type="email" id="form2Example11" class="form-control" name="email" value="{{ old('email') }}"
                      required/>
                      <label id="label-email">Username</label>
                    </div>
  
                    <div class="input_wrap mb-4">
                      <input id="input-pass" type="password" id="form2Example22" class="form-control" name="password" required/>
                      <label id="label-pass">Password</label>
                    </div>
  
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button id="btn-login" class="btn btn-danger d-block w-100 gradient-custom-2 mb-3" type="submit">Log
                        in</button>
                      {{-- <a class="text-muted" href="#!">Forgot password?</a> --}}
                    </div>
  
                    {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Don't have an account?</p>
                      <button type="button" class="btn btn-outline-danger">Create new</button>
                    </div> --}}
  
                  </form>
  
                </div>
              </div>
              <div style="background-color: #e0e0e0" class="col-lg-6 d-flex flex-column align-items-center justify-content-center gradient-custom-2">
                {{-- <img src="images/logo-clean.png" class="py-4" alt=""> --}}
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">We are more than just a company</h4>
                  <p class="small mb-0">Selamat datang di halaman login staf PT. Kris Cargo Bahtera. Login dan mulailah menjalankan tugas Anda hari ini. Bersama-sama, kita akan mencapai kesuksesan dan mewujudkan visi perusahaan. Jadilah bagian dari tim yang gigih dan berdedikasi dalam memberikan layanan terbaik untuk pelanggan kami. Jika mengalami masalah saat login, hubungi tim dukungan IT kami.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
<script src="{{ asset('assets/js/login.js') }}"></script>
{{-- toastr notification if there is error --}}
@if ($errors->any())
<script>
  toastr.error("{{ $errors->first() }}");
</script>
@endif
@endsection