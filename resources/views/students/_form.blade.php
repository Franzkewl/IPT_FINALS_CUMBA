<form method="POST"
      action="{{ $student->exists ? route('students.update', $student) : route('students.store') }}">
    @csrf
    @if ($student->exists)
        @method('PUT')
    @endif

    <p>
        <label for="first_name">First Name: </label>
        <input type="text" id="first_name" name="first_name"
               value="{{ old('first_name', $student->first_name) }}">
        @error('first_name')
            <br><small>{{ $message }}</small>
        @enderror
    
    
        <label for="middle_initial">Middle Initial: </label>
        <input type="text" id="middle_initial" name="middle_initial"
               value="{{ old('middle_initial', $student->middle_initial) }}" style="width: 10px;">
        @error('middle_initial')
            <br><small>{{ $message }}</small>
        @enderror
    

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"
               value="{{ old('last_name', $student->last_name) }}">
        @error('last_name')
            <br><small>{{ $message }}</small>
        @enderror
        <br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $student->gender) === 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender')
            <br><small>{{ $message }}</small>
        @enderror

        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate"
               value="{{ old('birthdate', $student->birthdate) }}">
        @error('birthdate')
            <br><small>{{ $message }}</small>
        @enderror


        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
               value="{{ old('email', $student->email) }}">
        @error('email')
            <br><small>{{ $message }}</small>
        @enderror
        
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number"
               value="{{ old('contact_number', $student->contact_number) }}">
        @error('contact_number')
            <br><small>{{ $message }}</small>
        @enderror

        <br>
        <label for="course">Course:</label>
        <input type="text" id="course" name="course"
               value="{{ old('course', $student->course) }}" style="width: 50px;">
        @error('course')
            <br><small>{{ $message }}</small>
        @enderror

        <label for="year_level">Year Level:</label>
        <input type="number" id="year_level" name="year_level"
               value="{{ old('year_level', $student->year_level) }}" min="1" max="5" style="width: 25px;">   
        @error('year_level')
            <br><small>{{ $message }}</small>
        @enderror


    </p>

    <button type="submit">Save</button>
    <a href="{{ route('students.index') }}">Cancel</a>
</form>