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

@section('address', 'Category List')

@section('breadcrumb')
<li class="breadcrumb-item active">Categories</li>
@parent
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Create New Category
    </a>
</div>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>
                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" height="50px">
            </td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent_id ?? 'No Parent' }}</td>
            <td>{{ $category->created_at->format('Y-m-d') }}</td>
            <td class="d-flex">
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success mr-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No Categories found</td>
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
