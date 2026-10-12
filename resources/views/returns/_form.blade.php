<form method="POST"
      action="{{ $return->exists ? route('returns.update', $return) : route('returns.store') }}">
    @csrf
    @if ($return->exists)
        @method('PUT')
    @endif

     <p>
        <label for="borrowing_id">Borrower</label><br>
            <select id="borrowing_id" name="borrowing_id">
                <option value="">-- Select Borrowing --</option>
                @foreach ($borrowings as $borrowing)
                    <option value="{{ $borrowing->borrowing_id }}"
                        @selected(old('borrowing_id', $return->borrowing_id ?? null) == $borrowing->borrowing_id)>
                        {{ $borrowing->student->first_name }} {{ $borrowing->student->last_name }}
                    </option>
                @endforeach
            </select>
            @error('borrowing_id')
                <br><small>{{ $message }}</small>
            @enderror
    </p>
    
    <p>

        <label for="returned_date">Returned Date:</label>
        <input type="date" id="returned_date" name="returned_date"
            value="{{ old('returned_date', $return->returned_date ? $return->returned_date->format('Y-m-d') : '') }}">
        @error('returned_date')
            <br><small>{{ $message }}</small>
        @enderror

    </p>

    <p>
       <label for="condition">Condition</label><br>
        <select id="condition" name="condition">
            @foreach (\App\Models\ReturnRecord::CONDITIONS['condition'] as $c)
                <option value="{{ $c }}" @selected(old('condition', $return->condition ?? null) === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('condition')
            <br><small>{{ $message }}</small>
        @enderror
    </p>

    
    <p>

        <label for="late_days">Late Days:</label>
        <input type="number" id="late_days" name="late_days"
               value="{{ old('late_days', $return->late_days ?? 0) }}" min="0">
        @error('late_days')
            <br><small>{{ $message }}</small>
        @enderror

    </p>

    <p>

        <label for="late_fee">Late Fee:</label>
        <input type="number" id="late_fee" name="late_fee"
               value="{{ old('late_fee', $return->late_fee ?? 0) }}" min="0" step="0.01">
        @error('late_fee')
            <br><small>{{ $message }}</small>
        @enderror

    </p>

    <p>
        <label for="received_by">Received By:</label>
        <input type="text" id="received_by" name="received_by"
               value="{{ old('received_by', $return->received_by) }}">
        @error('received_by')
            <br><small>{{ $message }}</small>
        @enderror

    <button type="submit">Save</button>
    <a href="{{ route('returns.index') }}">Cancel</a>
</form>