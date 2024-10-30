@extends('layouts.dashboard')
@section('title', 'Products')

@push('styles')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endpush

@section('address', 'Store List')

@section('breadcrumb')
<li class="breadcrumb-item active">Products</li>
@parent
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <h2 class="m-0">Products</h2>
    <div>
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-sm me-2">
            <i class="fas fa-plus"></i> Create New Product
        </a>
        {{--
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-trash"></i> Trashed Stores
        </a>
        --}}
    </div>
</div>

<x-alert type='success' />
<x-alert type='info' />

{{-- Search form (uncomment to use) --}}
{{--
<form action="{{ URL::current() }}" class="d-flex justify-content-between mb-5" method="GET">
<div class="form-group">
    <label for="name">Search Store</label>
    <input type="text" name="name" id="name" value="{{ request('name') }}" class="form-control" placeholder="Enter store name">
    <select name="status" class="form-control">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark">Filter</button>
</div>
</form>
--}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Products List</h3>
    </div>
    <div class="card-body">
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Products List</h2>
            <table class="table table-hover table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Compare Price</th>
                        <th>Rating</th>
                        <th>Feature</th>
                        <th>Status</th>
                        <th>Store</th> <!-- عرض اسم المتجر -->
                        <th>Category </th> <!-- عرض اسم الفئة -->
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- id يبدأ من 1 -->
                        <td>
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" height="50px" class="img-thumbnail">
                            @else
                            <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->compare_price ?? 'N/A' }}</td>
                        <td>{{ $product->rating }}</td>
                        <td>{{ $product->feature ? 'Yes' : 'No' }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->store->name ?? 'No Store' }}</td> <!-- عرض اسم المتجر -->
                        <td>{{ $product->category->name ?? 'No Category' }}</td> <!-- عرض اسم الفئة -->

                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        <td class="d-flex">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-sm btn-outline-success me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                        <td colspan="14" class="text-center">No products found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->withQueryString()->appends(['search' => 1])->links() }}
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
