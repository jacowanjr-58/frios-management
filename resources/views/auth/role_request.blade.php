<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Request Role</title>
</head>
<body>
    <h2>Request Access Role</h2>

    <div class="bg-gray-100 p-4 mb-4 rounded shadow">
        <h3 class="text-lg font-bold">Debug Info</h3>
        <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Roles:</strong> {{ auth()->user()->getRoleNames()->implode(', ') }}</p>
        <p><strong>Franchisees:</strong> {{ auth()->user()->franchisees->pluck('name')->implode(', ') }}</p>
    </div>

    <form method="POST" action="{{ route('role.request.submit') }}">
        @csrf
        <label for="desired_role">Select Desired Role:</label>
        <select name="desired_role" id="desired_role" required>
            @foreach($roles as $role)
                @if($role !== 'super_admin')
                    <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                @endif
            @endforeach
        </select>

        <label for="franchisee_ids">Select Franchise(s):</label>
        <select name="franchisee_ids[]" id="franchisee_ids" required>
            @foreach($franchisees as $franchisee)
                <option value="{{ $franchisee->id }}">{{ $franchisee->name }}</option>
            @endforeach
        </select>

        <button type="submit">Submit Request</button>
    </form>

    <script>
        const roleSelect = document.getElementById('desired_role');
        const franchiseSelect = document.getElementById('franchisee_ids');

        function updateFranchiseSelect() {
            if (roleSelect.value === 'franchise_admin') {
                franchiseSelect.setAttribute('multiple', 'multiple');
            } else {
                franchiseSelect.removeAttribute('multiple');
            }
        }

        roleSelect.addEventListener('change', updateFranchiseSelect);
        window.addEventListener('DOMContentLoaded', updateFranchiseSelect);
    </script>
</body>
</html>
