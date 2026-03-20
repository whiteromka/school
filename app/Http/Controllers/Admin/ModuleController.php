<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use Yajra\DataTables\Facades\DataTables;

class ModuleController extends Controller
{
    /**
     * Display modules list page
     */
    public function index()
    {
        return view('admin.modules.index');
    }

    /**
     * Get data for DataTables (server-side processing)
     */
    public function data()
    {
        $modules = Module::query();

        return DataTables::of($modules)
            ->addColumn('actions', function ($module) {
                return '
                    <a href="' . route('admin.modules.edit', $module->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('admin.modules.destroy', $module->id) . '" method="POST" class="d-inline"
                          onsubmit="return confirm(\'Are you sure?\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->editColumn('type', function ($module) {
                $badgeClass = match($module->type) {
                    'Back' => 'bg-primary',
                    'Front' => 'bg-success',
                    'Eng' => 'bg-info',
                    default => 'bg-secondary',
                };
                return '<span class="badge ' . $badgeClass . '">' . $module->type . '</span>';
            })
            ->editColumn('level', function ($module) {
                return 'Level ' . $module->level;
            })
            ->editColumn('module_price', function ($module) {
                return number_format($module->module_price) . ' ₽';
            })
            ->editColumn('lesson_price', function ($module) {
                return number_format($module->lesson_price) . ' ₽';
            })
            ->editColumn('active', function ($module) {
                return $module->active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>';
            })
            ->editColumn('count_lessons', function ($module) {
                return $module->count_lessons . ' lessons';
            })
            ->editColumn('techs', function ($module) {
                if (empty($module->techs)) {
                    return '-';
                }
                return collect($module->techs)
                    ->map(fn($tech) => '<span class="badge bg-secondary me-1">' . $tech . '</span>')
                    ->implode('');
            })
            ->rawColumns(['type', 'actions', 'active', 'techs'])
            ->make(true);
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store new module
     */
    public function store(ModuleRequest $request)
    {
        $techs = is_string($request->techs) 
            ? array_filter(array_map('trim', explode(',', $request->techs)))
            : ($request->techs ?? []);
        
        $topics = is_string($request->topics)
            ? array_filter(array_map('trim', explode("\n", $request->topics)))
            : ($request->topics ?? []);

        Module::create([
            'type' => $request->type,
            'number' => $request->number,
            'name' => $request->name,
            'level' => $request->level,
            'module_price' => $request->module_price,
            'lesson_price' => $request->lesson_price,
            'topics' => $topics,
            'techs' => $techs,
            'duration' => $request->duration,
            'count_lessons' => $request->count_lessons,
            'description' => $request->description,
            'description2' => $request->description2,
            'author' => $request->author,
            'active' => $request->active ?? false,
        ]);

        return redirect()->route('admin.modules')
            ->with('success', 'Module created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update module
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $techs = is_string($request->techs) 
            ? array_filter(array_map('trim', explode(',', $request->techs)))
            : ($request->techs ?? []);
        
        $topics = is_string($request->topics)
            ? array_filter(array_map('trim', explode("\n", $request->topics)))
            : ($request->topics ?? []);

        $data = [
            'type' => $request->type,
            'number' => $request->number,
            'name' => $request->name,
            'level' => $request->level,
            'module_price' => $request->module_price,
            'lesson_price' => $request->lesson_price,
            'topics' => $topics,
            'techs' => $techs,
            'duration' => $request->duration,
            'count_lessons' => $request->count_lessons,
            'description' => $request->description,
            'description2' => $request->description2,
            'author' => $request->author,
            'active' => $request->active ?? false,
        ];

        $module->update($data);

        return redirect()->route('admin.modules')
            ->with('success', 'Module updated successfully!');
    }

    /**
     * Delete module
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('admin.modules')
            ->with('success', 'Module deleted successfully!');
    }
}
