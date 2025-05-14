<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Request Role</title>
</head>
<body>
    <h2>Select Role and Franchise</h2>
    <form method="POST" action="{{ route('role.request.submit') }}">
        @csrf
        <label for="desired_role">Desired Role:</label>
        <select name="desired_role" required>
            @foreach($roles as $role)
                <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
            @endforeach
        </select>

        <label for="franchisee_ids">Select Franchise(s):</label>
        <select name="franchisee_ids[]" multiple>
            @foreach($franchisees as $franchisee)
                <option value="{{ $franchisee->id }}">{{ $franchisee->name }}</option>
            @endforeach
        </select>

        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
