@if ($errors->any())
<div class="alert alert-danger">
    <h3>Error Occurred</h3>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<!-- Product Name -->
<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" placeholder="Enter product name" required>
</div>

<!-- Store -->
{{-- <div class="form-group">
    <label for="store_id">Store</label>
    <select name="store_id" id="store_id" class="form-control" required>
        <option value="">Select Store</option>
        @foreach ($stores as $storeItem)
        <option value="{{ $storeItem->id }}" {{ old('store_id', $product->store_id ?? '') == $storeItem->id ? 'selected' : '' }}>
{{ $storeItem->name }}
</option>
@endforeach
</select>
</div> --}}

<!-- Category -->
<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach ($categories as $categoryItem)
        <option value="{{ $categoryItem->id }}" {{ old('category_id', $product->category_id ?? '') == $categoryItem->id ? 'selected' : '' }}>
            {{ $categoryItem->name }}
        </option>
        @endforeach
    </select>
</div>

<!-- Description -->
<div class="form-group">
    <label for="description">Product Description</label>
    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<!-- Image -->
<div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(isset($product) && $product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" height="50px" class="mt-2">
    @endif
</div>

<!-- Price -->
<div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? 0) }}" class="form-control" placeholder="Enter price" step="0.01" required>
</div>

<!-- Compare Price -->
<div class="form-group">
    <label for="compare_price">Compare Price</label>
    <input type="number" name="compare_price" id="compare_price" value="{{ old('compare_price', $product->compare_price ?? '') }}" class="form-control" placeholder="Enter compare price" step="0.01">
</div>

<!-- Product Tags -->
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" class="form-control" value="{{ old('tags', $tags ?? '') }}" placeholder="Enter product tags, separated by commas" required>
</div>

<!-- Status -->
<div class="form-group">
    <label>Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" {{ old('status', $product->status ?? '') == 'active' ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="draft" {{ old('status', $product->status ?? '') == 'draft' ? 'checked' : '' }}>
            <label class="form-check-label">Draft</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" {{ old('status', $product->status ?? '') == 'archived' ? 'checked' : '' }}>
            <label class="form-check-label">Archived</label>
        </div>
    </div>
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
