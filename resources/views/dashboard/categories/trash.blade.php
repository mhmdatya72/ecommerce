@extends('layouts.dashboard')
@section('title', 'Categories Trash')

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
<li class="breadcrumb-item ">Categories</li>
<li class="breadcrumb-item active">Trash</li>
@parent
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <h2 class="m-0">Categories</h2>
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Back New Category
    </a>
</div>

<x-alert type='success' />
<x-alert type='info' />
<form action="{{ URL::current() }}" class="d-flex justify-content-between mb-5" method="GET">
    <div class="form-group">
        <label for="name">Search Category</label>
        <input type="text" name="name" id="name" :value="request('name')" class="form-control" placeholder="Enter category name">
        <select name="status" class="form-control">
            <option value="">All </option>
            <option value="active" @selected(request('status')=='active' )>Active </option>
            <option value="archived" @selected(request('status')=='archived' )>Archived </option>
        </select>
        <button class="btn btn-dark">Filter</button>
    </div>

</form>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Category List</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>

                    <th>Status</th>
                    <th>Deleted At</th>
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
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at->format('Y-m-d') }}</td>
                    <td class="d-flex">

                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('Put')
                            <button type="submit" class="btn btn-sm btn-outline-success mr-2">
                                <iclass="fas fa-edit">
                                    </iclass=> Restore
                            </button>
                        </form>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Force Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No Categories found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $categories->withQueryString()->appends(['search' => 1])->links() }}
        </div>
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
