@extends('layouts.dashboard')
@section('title', 'Products')

@push('styles')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Custom Styles -->
<style>
    .form-container {
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-header {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .form-header h2 {
        margin: 0;
        color: #007bff;
    }

    .form-control {
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

</style>
@endpush

@section('address', 'Create New Categories')

@section('breadcrumb')
<li class="breadcrumb-item active">Create Products</li>
@parent
@endsection

@section('content')
<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h2>Create New product</h2>
        </div>
        <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('dashboard.products._form')
        </form>
    </div>
</div>
@stop

@push('scripts')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
