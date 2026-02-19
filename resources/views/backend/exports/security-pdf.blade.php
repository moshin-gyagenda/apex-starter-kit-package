<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Security Logs Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 5px 6px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        tr:nth-child(even) { background-color: #fafafa; }
        .header { margin-bottom: 15px; }
        .header h1 { margin: 0; font-size: 16px; }
        .header p { margin: 4px 0 0 0; color: #666; font-size: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Security Logs Export</h1>
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }} • {{ $logs->count() }} record(s)</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Event Type</th>
                <th>Severity</th>
                <th>IP Address</th>
                <th>User/Email</th>
                <th>Description</th>
                <th>Blocked</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $log->event_type_label ?? $log->event_type }}</td>
                    <td>{{ ucfirst($log->severity) }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->user ? $log->user->name : ($log->email ?? 'N/A') }}</td>
                    <td>{{ Str::limit($log->description ?? 'N/A', 50) }}</td>
                    <td>{{ $log->blocked ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
