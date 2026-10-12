<form method="POST"
      action="{{ $equipment->exists ? route('equipments.update', $equipment) : route('equipments.store') }}">
    @csrf
    @if ($equipment->exists)
        @method('PUT')
    @endif

    <p>
        <label for="equipment_name">Name </label><br>
        <input type="text" id="equipment_name" name="equipment_name"
               value="{{ old('equipment_name', $equipment->equipment_name) }}">
        @error('equipment_name')
            <br><small>{{ $message }}</small>
        @enderror
    </p>
    
    <label for="category_id">Category</label><br>
        <select id="category_id" name="category_id">
            <option value="">-- Select category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                    @selected(old('category_id', $equipment->category_id ?? null) == $category->category_id)>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <br><small>{{ $message }}</small>
        @enderror

    <p>
        <label for="description">Description</label><br>
        <textarea id="description" name="description" rows="3" cols="40">{{ old('description', $equipment->description) }}</textarea>
        @error('description')
            <br><small>{{ $message }}</small>
        @enderror
    </p>
    <p>
        <label for="condition">Condition</label><br>
        <select id="condition" name="condition">
            @foreach (\App\Models\Equipment::CONDITIONS['status'] as $c)
                <option value="{{ $c }}" @selected(old('condition', $equipment->condition ?? 'available') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('condition')
            <br><small>{{ $message }}</small>
        @enderror
    <p>
        <label for="quantity_total">Total quantity</label><br>
        <input type="number" min="1" id="quantity_total" name="quantity_total"
               value="{{ old('quantity_total', $equipment->quantity_total) }}">
        @error('quantity_total')
            <br><small>{{ $message }}</small>
        @enderror

    <button type="submit">{{ $equipment->exists ? 'Save' : 'Create' }}</button>
    <a href="{{ route('categories.index') }}">Cancel</a>
</form>