<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Matrix</title>
</head>
<body>
    <h2>Permission Matrix</h2>
    <form id="permission-form">
        <table id="permission-matrix" border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Permission</th>
                    @foreach($roles as $role)
                        <th>{{ ucfirst(str_replace('_', ' ', $role->name)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        @foreach($roles as $role)
                            <td>
                                <input type="checkbox"
                                    data-role="{{ $role->name }}"
                                    data-permission="{{ $permission->name }}"
                                    @if($role->hasPermissionTo($permission->name)) checked @endif
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" onclick="submitMatrix()">Save Changes</button>
    </form>

    <script>
    function submitMatrix() {
        const checkboxes = document.querySelectorAll('#permission-matrix input[type="checkbox"]');
        const permissions = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                permissions.push({
                    role: cb.dataset.role,
                    permission: cb.dataset.permission
                });
            }
        });

        fetch('/permissions/update-matrix', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({permissions})
        })
        .then(res => res.json())
        .then(data => alert('Permissions updated!'));
    }
    </script>
</body>
</html>
