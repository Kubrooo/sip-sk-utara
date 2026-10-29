<?php

namespace App\Http\Controllers;

use App\Models\SkTemplate;
use App\Http\Requests\StoreSkTemplateRequest;
use App\Http\Requests\UpdateSkTemplateRequest;
use Illuminate\Http\Request;

class SkTemplateController extends Controller
{
    /**
     * Display a listing of SK templates.
     */
    public function index()
    {
        $templates = SkTemplate::withCount('submissions')->latest()->paginate(10);
        return view('templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new SK template.
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Store a newly created SK template in storage.
     */
    public function store(StoreSkTemplateRequest $request)
    {
        SkTemplate::create($this->prepareTemplateData($request->validated(), $request->boolean('is_active')));

        return redirect()->route('templates.index')->with('success', 'Template SK berhasil ditambahkan.');
    }

    /**
     * Display the specified SK template.
     */
    public function show(SkTemplate $template)
    {
        return view('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified SK template.
     */
    public function edit(SkTemplate $template)
    {
        return view('templates.edit', compact('template'));
    }

    /**
     * Update the specified SK template in storage.
     */
    public function update(UpdateSkTemplateRequest $request, SkTemplate $template)
    {
        if ($template->submissions()->exists()) {
            return back()->withInput()->with('error', 'Template yang sudah dipakai tidak dapat diubah. Buat versi template baru agar dokumen lama tetap konsisten.');
        }

        $template->update($this->prepareTemplateData($request->validated(), $request->boolean('is_active')));

        return redirect()->route('templates.index')->with('success', 'Template SK berhasil diperbarui.');
    }

    /**
     * Remove the specified SK template from storage.
     */
    public function destroy(SkTemplate $template)
    {
        if ($template->submissions()->exists()) {
            return back()->with('error', 'Template tidak dapat dihapus karena sudah memiliki dokumen terikat. Nonaktifkan template sebagai gantinya.');
        }

        $template->delete();

        return redirect()->route('templates.index')->with('success', 'Template SK berhasil dihapus.');
    }

    private function prepareTemplateData(array $validated, bool $isActive): array
    {
        $validated['is_active'] = $isActive;

        foreach ($validated['dynamic_fields'] as &$field) {
            $field['required'] = !empty($field['required']);
            $field['options'] = $field['type'] === 'select' && !empty($field['options'])
                ? array_values(array_filter(array_map('trim', explode(',', $field['options']))))
                : [];
        }

        return $validated;
    }

}
