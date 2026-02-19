@extends('backend.layouts.app')

@section('content')
<div class="p-4 sm:ml-64 flex flex-col min-h-screen">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mt-16 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ config('app.name', 'Apex Starter Kit') }} Dashboard</h1>
            <p class="text-sm text-gray-500 mt-0.5">Overview of your application</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm font-medium">
                <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                Users
            </a>
            <a href="{{ route('admin.security.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm font-medium">
                <i data-lucide="shield-alert" class="w-4 h-4 mr-2"></i>
                Security
            </a>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4 mb-6">
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md hover:border-primary-200 transition-all">
            <div class="flex flex-row items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
                <i data-lucide="users" class="w-5 h-5 text-primary-500"></i>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</div>
            <p class="pt-1 text-xs text-gray-500">Registered accounts</p>
        </a>

        <a href="{{ route('admin.users.index') }}?verified=1" class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md hover:border-primary-200 transition-all">
            <div class="flex flex-row items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-500">Verified Users</h3>
                <i data-lucide="user-check" class="w-5 h-5 text-green-500"></i>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($verifiedUsers) }}</div>
            <p class="pt-1 text-xs text-gray-500">Email verified</p>
        </a>

        <a href="{{ route('admin.roles.index') }}" class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md hover:border-primary-200 transition-all">
            <div class="flex flex-row items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-500">Roles</h3>
                <i data-lucide="key-round" class="w-5 h-5 text-primary-500"></i>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($totalRoles) }}</div>
            <p class="pt-1 text-xs text-gray-500">Manage in Settings</p>
        </a>

        <a href="{{ route('admin.security.index') }}" class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md hover:border-primary-200 transition-all">
            <div class="flex flex-row items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-500">Security Events</h3>
                <i data-lucide="shield-alert" class="w-5 h-5 text-primary-500"></i>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($securityEventsTotal) }}</div>
            <p class="pt-1 text-xs text-gray-500">{{ $securityEventsToday }} today</p>
        </a>
    </div>

    <!-- Charts Section -->
    <div class="grid gap-6 md:grid-cols-2 mb-6">
        <!-- Users by Role -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-row items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Users by Role</h3>
                    <p class="text-sm text-gray-500">Distribution across roles</p>
                </div>
                <a href="{{ route('admin.roles.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">View roles</a>
            </div>
            <div class="h-80">
                <canvas id="usersByRoleChart"></canvas>
            </div>
        </div>

        <!-- Security Activity by Month -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-row items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Security Activity by Month</h3>
                    <p class="text-sm text-gray-500">Events in {{ now()->year }}</p>
                </div>
                <a href="{{ route('admin.security.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">View logs</a>
            </div>
            <div class="h-80">
                <canvas id="activityByMonthChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Latest Users -->
    <div class="grid gap-6 lg:grid-cols-7 mb-6">
        <!-- Recent Security Activity -->
        <div class="lg:col-span-4 bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-row items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Recent Security Activity</h3>
                    <p class="text-sm text-gray-500">Latest security events</p>
                </div>
                <a href="{{ route('admin.security.index') }}" class="px-3 py-1.5 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    View All
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentSecurityLogs as $log)
                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-3 hover:bg-gray-50 transition-colors">
                    <div class="min-w-0 flex-1">
                        <p class="font-medium text-gray-900 truncate">{{ $log->event_type_label ?? $log->event_type }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ Str::limit($log->description ?? $log->ip_address, 50) }}</p>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                        <span class="text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full
                            @if($log->severity === 'critical') bg-red-100 text-red-800
                            @elseif($log->severity === 'high') bg-orange-100 text-orange-800
                            @elseif($log->severity === 'medium') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($log->severity) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500 rounded-lg border border-gray-200">
                    No security events yet.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Latest Users -->
        <div class="lg:col-span-3 bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-row items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Latest Users</h3>
                    <p class="text-sm text-gray-500">Recently registered</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="px-3 py-1.5 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    View All
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentUsers as $user)
                <a href="{{ route('admin.users.show', $user) }}" class="flex items-center gap-4 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 transition-colors">
                    <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-semibold text-sm flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-medium text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        @if($user->roles->isNotEmpty())
                            <span class="text-xs font-medium text-gray-600">{{ ucfirst(str_replace('-', ' ', $user->roles->first()->name)) }}</span>
                        @else
                            <span class="text-xs text-gray-400">—</span>
                        @endif
                        <p class="text-xs text-gray-400 mt-0.5">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                @empty
                <div class="p-6 text-center text-gray-500 rounded-lg border border-gray-200">
                    No users yet.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    lucide.createIcons();

    const colors = [
        'rgba(249, 115, 22, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(59, 130, 246, 0.8)',
        'rgba(139, 92, 246, 0.8)',
        'rgba(239, 68, 68, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(20, 184, 166, 0.8)',
        'rgba(236, 72, 153, 0.8)'
    ];

    const usersByRoleData = @json($usersByRoleChartData);
    const usersByRoleLabels = usersByRoleData.map(item => item.label);
    const usersByRoleCounts = usersByRoleData.map(item => item.count);

    const usersByRoleCtx = document.getElementById('usersByRoleChart');
    if (usersByRoleCtx) {
        new Chart(usersByRoleCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: usersByRoleLabels,
                datasets: [{
                    data: usersByRoleCounts,
                    backgroundColor: colors.slice(0, usersByRoleLabels.length),
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { color: '#374151', padding: 12, usePointStyle: true } }
                }
            }
        });
    }

    const activityByMonthData = @json($activityByMonth);
    const activityByMonthCtx = document.getElementById('activityByMonthChart');
    if (activityByMonthCtx) {
        new Chart(activityByMonthCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: activityByMonthData.map(item => item.month_name),
                datasets: [{
                    label: 'Security events',
                    data: activityByMonthData.map(item => item.count),
                    backgroundColor: 'rgba(249, 115, 22, 0.7)',
                    borderColor: 'rgba(249, 115, 22, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { color: '#374151' }, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { ticks: { color: '#374151' }, grid: { color: 'rgba(0,0,0,0.05)' } }
                },
                plugins: { legend: { labels: { color: '#374151' } } }
            }
        });
    }

    setTimeout(() => lucide.createIcons(), 100);
</script>
@endsection
