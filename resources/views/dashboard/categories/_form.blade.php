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

<!-- Category Name -->
<div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" class="form-control" placeholder="Enter category name">
</div>

<!-- Parent Category -->
<div class="form-group">
    <label for="parent_id">Parent Category</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach ($parent as $parentItem)
        <option value="{{ $parentItem->id }}" {{ old('parent_id', $category->parent_id ?? '') == $parentItem->id ? 'selected' : '' }}>
            {{ $parentItem->name }}
        </option>
        @endforeach
    </select>
</div>

<!-- Description -->
<div class="form-group">
    <label for="description">Category Description</label>
    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter category description">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<!-- Image -->
<div class="form-group">
    <label for="image">Category Image</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(isset($category) && $category->image)
    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" height="50px">
    @endif
</div>

<!-- Status -->
<div class="form-group">
    <label>Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" {{ old('status', $category->status ?? '') == 'active' ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" {{ old('status', $category->status ?? '') == 'archived' ? 'checked' : '' }}>
            <label class="form-check-label">Archived</label>
        </div>
    </div>
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
