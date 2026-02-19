<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SecurityLog;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index page.
     */
    public function index()
    {
        $totalUsers = User::count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $totalRoles = Role::count();
        $isProduction = app()->isProduction();

        $securityEventsToday = $isProduction ? SecurityLog::whereDate('created_at', today())->count() : 0;
        $securityEventsTotal = $isProduction ? SecurityLog::count() : 0;

        $usersByRole = User::query()
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_type', User::class)
            ->select('roles.name as role_name', DB::raw('count(*) as count'))
            ->groupBy('roles.name')
            ->orderByDesc('count')
            ->get();

        $usersByRoleChartData = $usersByRole->isEmpty()
            ? [['label' => 'No roles', 'count' => 0]]
            : $usersByRole->map(fn ($r) => [
                'label' => ucfirst(str_replace('-', ' ', $r->role_name)),
                'count' => (int) $r->count,
            ])->values()->all();

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if ($isProduction) {
            $securityByMonth = SecurityLog::query()
                ->whereYear('created_at', now()->year)
                ->selectRaw('CAST(strftime(\'%m\', created_at) AS INTEGER) as month, count(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');

            $activityByMonth = collect(range(1, 12))->map(fn ($m) => [
                'month_name' => $monthNames[$m - 1],
                'count' => $securityByMonth->get($m)?->count ?? 0,
            ])->values()->all();

            $recentSecurityLogs = SecurityLog::with('user')->latest()->limit(8)->get();
        } else {
            $activityByMonth = collect(range(1, 12))->map(fn ($m) => [
                'month_name' => $monthNames[$m - 1],
                'count' => 0,
            ])->values()->all();

            $recentSecurityLogs = collect();
        }

        $recentUsers = User::with('roles')
            ->latest()
            ->limit(5)
            ->get();

        return view('backend.dashboard.index', [
            'totalUsers' => $totalUsers,
            'verifiedUsers' => $verifiedUsers,
            'totalRoles' => $totalRoles,
            'securityEventsToday' => $securityEventsToday,
            'securityEventsTotal' => $securityEventsTotal,
            'usersByRoleChartData' => $usersByRoleChartData,
            'activityByMonth' => $activityByMonth,
            'recentSecurityLogs' => $recentSecurityLogs,
            'recentUsers' => $recentUsers,
            'isProduction' => $isProduction,
        ]);
    }
}
