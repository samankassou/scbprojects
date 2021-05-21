@extends('layouts.app', ['title' => 'Création d\'un projet'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Création d'un projet</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection