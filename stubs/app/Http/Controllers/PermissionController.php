<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PermissionController extends Controller
{
    protected function getPermissionsQuery(Request $request, array $ids = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = Permission::withCount('roles');
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return $query->orderBy('name');
    }

    /**
     * Display a listing of permissions.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $perPage = in_array($perPage, [10, 15, 25, 50, 100], true) ? $perPage : 15;

        $query = $this->getPermissionsQuery($request);
        $permissions = $query->paginate($perPage)->withQueryString();
        $stats = [
            'total' => Permission::count(),
            'assigned_to_roles' => Permission::has('roles')->count(),
        ];

        return view('backend.permissions.index', compact('permissions', 'stats'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $ids = $request->filled('ids') ? (array) $request->ids : [];
        $query = $this->getPermissionsQuery($request, $ids);
        $permissions = $query->get();
        $filename = 'permissions_export_' . now()->format('Y-m-d_His') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];
        $callback = function () use ($permissions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Permission', 'Roles Count']);
            foreach ($permissions as $p) {
                fputcsv($file, [$p->id, $p->name, $p->roles_count ?? 0]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $ids = $request->filled('ids') ? (array) $request->ids : [];
        $query = $this->getPermissionsQuery($request, $ids);
        $permissions = $query->get();
        $pdf = Pdf::loadView('backend.exports.permissions-pdf', compact('permissions'));
        return $pdf->download('permissions_export_' . now()->format('Y-m-d_His') . '.pdf');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => ['required', 'array'], 'ids.*' => ['integer', 'exists:permissions,id']]);
        Permission::whereIn('id', $request->ids)->delete();
        return redirect()->route('admin.permissions.index')->with('success', count($request->ids) . ' permission(s) deleted successfully.');
    }

    /**
     * Return permission data for edit modal (JSON).
     */
    public function data(Permission $permission)
    {
        return response()->json([
            'id' => $permission->id,
            'name' => $permission->name,
        ]);
    }

    /**
     * Store a newly created permission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
        ]);

        Permission::create(['name' => $validated['name']]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Update the specified permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update(['name' => $validated['name']]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
