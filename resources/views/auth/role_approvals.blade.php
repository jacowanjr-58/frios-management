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
         @foreach($pendingRequests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->desired_role }}</td>
                        <td>{{ $request->franchisees->pluck('name')->join(', ') }}</td>
                        <td>
                            <form method="POST" action="{{ route('role.approvals.approve', $request) }}">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('role.approvals.reject', $request) }}">
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
