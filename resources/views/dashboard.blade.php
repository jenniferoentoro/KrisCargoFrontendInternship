@extends('layouts.app')

@section('title')
<title>Login</title>
@endsection
@section('style')
<style>




</style>
@endsection
@section('content')
    dashboard
@endsection
@section('script')
{{-- toastr notification if there is error --}}
@if ($errors->any())
<script>
  toastr.error("{{ $errors->first() }}");
</script>
{{-- IF THERE IS DATA WITH VARIABLE SUCCESS --}}
@endif
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@endsection