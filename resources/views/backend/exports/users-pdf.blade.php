<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        tr:nth-child(even) { background-color: #fafafa; }
        .header { margin-bottom: 15px; }
        .header h1 { margin: 0; font-size: 16px; }
        .header p { margin: 4px 0 0 0; color: #666; font-size: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Users Export</h1>
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }} • {{ $users->count() }} record(s)</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->isNotEmpty() ? $user->roles->first()->name : '—' }}</td>
                    <td>{{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
