<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Create Employee</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.storeEmployee') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <!-- <div class="mb-3">
            <label class="form-label">Employer (optional)</label>
            <select name="employer_id" class="form-select">
                <option value="">-- Select Employer --</option>
                @foreach($employers as $employer)
                    <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                        {{ $employer->name }}
                    </option>
                @endforeach
            </select>
        </div> -->

        <div class="mb-3">
            <label class="form-label">Position (optional)</label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Department (optional)</label>
            <input type="text" name="department" class="form-control" value="{{ old('department') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hire Date (optional)</label>
            <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Employee</button>
    </form>
</div>
</body>
</html>
