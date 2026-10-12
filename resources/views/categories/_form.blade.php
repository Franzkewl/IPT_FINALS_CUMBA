<form method="POST"
      action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}">
    @csrf
    @if ($category->exists)
        @method('PUT')
    @endif

    <p>
        <label for="category_name">Name </label><br>
        <input type="text" id="category_name" name="category_name"
               value="{{ old('category_name', $category->category_name) }}">
        @error('category_name')
            <br><small>{{ $message }}</small>
        @enderror
    </p>
    
    <p>
        <label for="description">Description</label><br>
        <textarea id="description" name="description" rows="3" cols="40">{{ old('description', $category->description) }}</textarea>
        @error('description')
            <br><small>{{ $message }}</small>
        @enderror
    </p>
    
    <button type="submit">{{ $category->exists ? 'Save' : 'Create' }}</button>
    <a href="{{ route('categories.index') }}">Cancel</a>

    <p>
        <label for="is_active">Status</label><br>
        <select id="is_active" name="is_active">
            <option value="1" @selected(old('is_active', $category->is_active) == 1)>Active</option>
            <option value="0" @selected(old('is_active', $category->is_active) == 0)>Inactive</option>
    </p>

    
</form>