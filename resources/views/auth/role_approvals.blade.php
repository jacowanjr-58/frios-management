<!DOCTYPE html>
<html>
<head>
    <title>Role Approvals</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Pending Role Requests</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Requested Role</th>
                <th>Franchisee IDs</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pending as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->user->email }}</td>
                    <td>{{ $request->desired_role }}</td>
                    <td>{{ implode(', ', $request->franchisee_ids ?? []) }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('role.approve', $request) }}" style="display:inline;">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('role.reject', $request) }}" style="display:inline;">
                            @csrf
                            <button type="submit">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
