@extends('layouts.app', ['title' => $title])
@section('styles')
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/toastify/toastify.css') }}">
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('mazer/assets/vendors/toastify/toastify.js') }}"></script>
@if (session('message'))
<script>
    Toastify({
    text: "{{ session('message') }}",
    duration: 3000,
    close:true,
    gravity:"top",
    position: "right",
    backgroundColor: "#4fbe87",
    }).showToast();
</script>
@endif
@endsection