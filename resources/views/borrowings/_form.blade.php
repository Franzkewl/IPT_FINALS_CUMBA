<form method="POST"
      action="{{ $borrowing->exists ? route('borrowings.update', $borrowing) : route('borrowings.store') }}">
    @csrf
    @if ($borrowing->exists)
        @method('PUT')
    @endif

    <p>
        <label for="student_id">Student</label><br>
            <select id="student_id" name="student_id">
                <option value="">-- Select Student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->student_id }}"
                        @selected(old('student_id', $borrowing->student_id ?? null) == $student->student_id)>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <br><small>{{ $message }}</small>
            @enderror
    </p>

    <p>
        <label for="equipment_id">equipment</label><br>
            <select id="equipment_id" name="equipment_id">
                <option value="">-- Select equipment --</option>
                @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->equipment_id }}"
                        @selected(old('equipment_id', $borrowing->equipment_id ?? null) == $equipment->equipment_id)>
                        {{ $equipment->equipment_name }}
                    </option>
                @endforeach
            </select>
            @error('equipment_id')
                <br><small>{{ $message }}</small>
            @enderror
    </p>
    
    <p>
        <label for="borrowed_date">Borrowed Date</label><br>
        <input type="date" id="borrowed_date" name="borrowed_date"
            value="{{ old('borrowed_date', $borrowing->borrowed_date ? $borrowing->borrowed_date->format('Y-m-d') : '') }}">
        @error('borrowed_date')
            <br><small>{{ $message }}</small>
        @enderror
        <br>
    </p>
    <p>
        <label for="due_date">Due Date</label><br>
        <input type="date" id="due_date" name="due_date"
            value="{{ old('due_date', $borrowing->due_date ? $borrowing->due_date->format('Y-m-d') : '') }}">
        @error('due_date')
            <br><small>{{ $message }}</small>
        @enderror
    </p>

    <p>
       <label for="status">Status</label><br>
        <select id="status" name="status">
            @foreach (\App\Models\Borrowing::STATS['status'] as $c)
                <option value="{{ $c }}" @selected(old('status', $borrowing->status ?? 'borrowed') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('status')
            <br><small>{{ $message }}</small>
        @enderror
    </p>

    <p>
        <label for="purpose">Purpose</label><br>
        <textarea id="purpose" name="purpose" rows="3" cols="40">{{ old('purpose', $borrowing->purpose) }}</textarea>
        @error('purpose')
            <br><small>{{ $message }}</small>
        @enderror
    </p>

    <p>
        <label for="released_by">Released By</label><br>
        <input type="text" id="released_by" name="released_by"
               value="{{ old('released_by', $borrowing->released_by) }}">
        @error('released_by')
            <br><small>{{ $message }}</small>
        @enderror
    </p>

    
    
    <button type="submit">{{ $borrowing->exists ? 'Save' : 'Create' }}</button>
    <a href="{{ route('borrowings.index') }}">Cancel</a>

</form>