<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission Matrix</title>
</head>
<body>
    <h2>Dynamic Permission Matrix</h2>

    <label for="user_id">Select User:</label>
    <select id="user_id" onchange="loadMatrix()">
        <option value="">-- Select a user --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select>

    <label for="role_select">Change Role:</label>
    <select id="role_select"></select>

    <div id="matrix-container" style="margin-top: 20px;"></div>
    <button onclick="submitMatrix()">Save Changes</button>

    <script>
    async function loadMatrix() {
        const userId = document.getElementById('user_id').value;
        if (!userId) return;

        const res = await fetch(`/permissions/user/${userId}`);
        const data = await res.json();

        const roleSelect = document.getElementById('role_select');
        roleSelect.innerHTML = '';
        data.roles.forEach(role => {
            const selected = data.user_roles.includes(role) ? 'selected' : '';
            roleSelect.innerHTML += `<option value="${role}" ${selected}>${role}</option>`;
        });

        let html = '<table border="1" cellpadding="6"><thead><tr><th>Permission</th>';
        data.roles.forEach(role => {
            html += `<th>${role}</th>`;
        });
        html += '</tr></thead><tbody>';

        data.permissions.forEach(permission => {
            html += `<tr><td>${permission}</td>`;
            data.roles.forEach(role => {
                const isChecked = data.user_permissions.includes(permission) ? 'checked' : '';
                html += \`<td><input type="checkbox" data-role="\${role}" data-permission="\${permission}" \${isChecked}></td>\`;
            });
            html += '</tr>';
        });

        html += '</tbody></table>';
        document.getElementById('matrix-container').innerHTML = html;
    }

    function submitMatrix() {
        const userId = document.getElementById('user_id').value;
        const selectedRole = document.getElementById('role_select').value;
        const checkboxes = document.querySelectorAll('#matrix-container input[type="checkbox"]');
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
            body: JSON.stringify({ user_id: userId, role: selectedRole, permissions })
        })
        .then(res => res.json())
        .then(data => alert('Permissions updated!'));
    }
    </script>
</body>
</html>
