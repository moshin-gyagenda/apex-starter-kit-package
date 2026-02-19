<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RoleController extends Controller
{
    protected function getRolesQuery(Request $request, array $ids = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = Role::withCount('permissions');
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return $query->orderBy('name');
    }

    /**
     * Display a listing of roles.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $perPage = in_array($perPage, [10, 15, 25, 50, 100], true) ? $perPage : 15;

        $query = $this->getRolesQuery($request);
        $roles = $query->paginate($perPage)->withQueryString();

        $roleIds = $roles->pluck('id');
        $usersCounts = $roleIds->isEmpty()
            ? collect()
            : DB::table('model_has_roles')->whereIn('role_id', $roleIds)->selectRaw('role_id, count(*) as c')->groupBy('role_id')->pluck('c', 'role_id');

        $permissions = Permission::orderBy('name')->get()->groupBy(fn ($p) => explode('-', $p->name)[0] ?? 'other');

        $stats = [
            'total' => Role::count(),
            'with_permissions' => Role::has('permissions')->count(),
            'with_users' => DB::table('model_has_roles')->distinct()->count('role_id'),
        ];

        return view('backend.roles.index', compact('roles', 'stats', 'permissions', 'usersCounts'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $ids = $request->filled('ids') ? (array) $request->ids : [];
        $query = $this->getRolesQuery($request, $ids);
        $roles = $query->get();
        $roleIds = $roles->pluck('id');
        $usersCounts = $roleIds->isEmpty() ? collect() : DB::table('model_has_roles')->whereIn('role_id', $roleIds)->selectRaw('role_id, count(*) as c')->groupBy('role_id')->pluck('c', 'role_id');

        $filename = 'roles_export_' . now()->format('Y-m-d_His') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];
        $callback = function () use ($roles, $usersCounts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Role', 'Permissions Count', 'Users Count']);
            foreach ($roles as $r) {
                fputcsv($file, [$r->id, $r->name, $r->permissions_count ?? 0, $usersCounts[$r->id] ?? 0]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $ids = $request->filled('ids') ? (array) $request->ids : [];
        $query = $this->getRolesQuery($request, $ids);
        $roles = $query->get();
        $pdf = Pdf::loadView('backend.exports.roles-pdf', compact('roles'));
        return $pdf->download('roles_export_' . now()->format('Y-m-d_His') . '.pdf');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => ['required', 'array'], 'ids.*' => ['integer', 'exists:roles,id']]);
        $ids = $request->ids;
        $withUsers = DB::table('model_has_roles')->whereIn('role_id', $ids)->distinct()->pluck('role_id');
        if ($withUsers->isNotEmpty()) {
            return redirect()->route('admin.roles.index')->with('error', 'Some selected roles are assigned to users and cannot be deleted.');
        }
        Role::whereIn('id', $ids)->delete();
        return redirect()->route('admin.roles.index')->with('success', count($ids) . ' role(s) deleted successfully.');
    }

    /**
     * Return role data for edit modal (JSON).
     */
    public function data(Role $role)
    {
        $role->load('permissions');
        return response()->json([
            'id' => $role->id,
            'name' => $role->name,
            'permission_names' => $role->permissions->pluck('name')->toArray(),
        ]);
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role = Role::create(['name' => $validated['name']]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Update the specified role.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role.
     */
    public function destroy(Role $role)
    {
        $usersCount = DB::table('model_has_roles')->where('role_id', $role->id)->count();
        if ($usersCount > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete role that is assigned to users. Remove the role from all users first.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
