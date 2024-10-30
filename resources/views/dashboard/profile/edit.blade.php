@extends('layouts.dashboard')
@section('title', 'Edit Profile')

@push('styles')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Custom Styles -->
<style>
    .container {
        max-width: 800px;
        margin: 40px auto;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }

    .form-header {
        border-bottom: 3px solid #007bff;
        margin-bottom: 20px;
    }

    .form-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #007bff;
    }

    .form-control {
        border-radius: 4px;
        margin-bottom: 15px;
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-check-label {
        margin-left: 10px;
    }

</style>
@endpush
@section('address', 'Update Profile')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
<div class="container">
    <div class="form-container">
        <div class="form-header">

        </div>
        <x-alert type="success" />
        <form action={{ route('dashboard.profile.update')}} method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            @include('dashboard.profile._form')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
