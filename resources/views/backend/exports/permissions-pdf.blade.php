<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permissions Export</title>
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
        <h1>Permissions Export</h1>
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }} • {{ $permissions->count() }} record(s)</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Permission</th>
                <th>Roles Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->roles_count ?? $permission->roles->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
