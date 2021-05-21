@extends('layouts.app', ['title' => 'Modification d\'un projet'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Modification d'un projet</h4>
        </div>
        <div class="card-body">
            
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection