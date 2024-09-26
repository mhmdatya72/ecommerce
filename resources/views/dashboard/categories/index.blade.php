@extends('layouts.dashboard')
@section('title', 'Categories')

@push('styles')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endpush

@section('address', 'Categories')

@section('breadcrumb')
<li class="breadcrumb-item active">Categories</li>
@parent
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
</div>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td><img src="{{ asset('storage/' . $category->image) }}" alt="!" height="50px"></td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent_id ?? 'No Parent' }}</td>
            <td>{{ $category->created_at->format('Y-m-d') }}</td>
            <td>
                <!-- Edit Icon -->
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-edit"></i> <!-- Font Awesome Edit icon -->
                </a>

                <!-- Delete Icon -->
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash"></i> <!-- Font Awesome Trash icon -->
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No Categories found</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

@push('scripts')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
