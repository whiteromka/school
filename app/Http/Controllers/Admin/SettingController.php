<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    // GET admin/settings/index
    public function index(): View
    {
        $settings = Setting::query()->paginate(20);
        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    // GET admin/settings/create
    public function create(): View
    {
        return view('admin.settings.create');
    }

    // POST admin/settings/store
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'value' => 'required',
            'description' => 'nullable|string|max:255',
        ]);

        Setting::query()->create($data);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting created');
    }

    // GET admin/settings/show
    public function show(Setting $setting): View
    {
        return view('admin.settings.show', [
            'setting' => $setting
        ]);
    }

    // GET admin/settings/edit
    public function edit(Setting $setting): View
    {
        return view('admin.settings.edit', [
            'setting' => $setting
        ]);
    }

    // PUT admin/settings/update
    public function update(Request $request, Setting $setting): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'nullable|string|min:3',
            'type' => 'nullable|string|max:255',
            'value' => 'required',
            'description' => 'nullable|string|max:255',
        ]);

        $setting->update($data);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting updated');
    }

    // DELETE admin/settings/destroy
    public function destroy(Setting $setting): RedirectResponse
    {
        $setting->delete();
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting deleted');
    }
}
