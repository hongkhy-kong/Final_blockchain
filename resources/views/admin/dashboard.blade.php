<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Header Section --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.createEmployer') }}">Create Employer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.createEmployee') }}">Create Employee</a>
                    </li>
                    {{-- Logout Form --}}
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Action buttons --}}
        <div class="mb-4 d-flex gap-3">
            <a href="{{ route('admin.createEmployer') }}" class="btn btn-primary">Create Employer</a>
            <a href="{{ route('admin.createEmployee') }}" class="btn btn-success">Create Employee</a>
        </div>

        {{-- Employers Table --}}
        <div class="card mb-5">
            <div class="card-header bg-primary text-white">Employers</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employers as $employer)
                            <tr>
                                <td>{{ $employer->id }}</td>
                                <td>{{ $employer->name }}</td>
                                <td>{{ $employer->email }}</td>
                                <td>{{ $employer->phone ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.editEmployer', $employer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.deleteEmployer', $employer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No employers found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Employees Table --}}
        <div class="card">
            <div class="card-header bg-success text-white">Employees</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Employer</th>
                            <th>Department</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->employer?->name ?? 'N/A' }}</td>
                                <td>{{ $employee->department ?? 'N/A' }}</td>
                                <td>{{ $employee->hire_date ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.editEmployee', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.deleteEmployee', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No employees found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
