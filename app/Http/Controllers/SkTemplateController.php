<?php

namespace App\Http\Controllers;

use App\Models\SkTemplate;
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:sk_templates,code'],
            'title' => ['required', 'string', 'max:255'],
            'html_template' => ['required', 'string'],
            'dynamic_fields' => ['required', 'array'],
            'dynamic_fields.*.name' => ['required', 'string'],
            'dynamic_fields.*.label' => ['required', 'string'],
            'dynamic_fields.*.type' => ['required', 'string', 'in:text,number,date,textarea,select'],
            'dynamic_fields.*.options' => ['nullable', 'string'],
            'dynamic_fields.*.required' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Process options string into array if present
        foreach ($validated['dynamic_fields'] as &$field) {
            $field['required'] = isset($field['required']) && $field['required'];
            if (!empty($field['options']) && is_string($field['options'])) {
                $field['options'] = array_map('trim', explode(',', $field['options']));
            } else if (empty($field['options'])) {
                $field['options'] = [];
            }
        }

        SkTemplate::create($validated);

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
    public function update(Request $request, SkTemplate $template)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:sk_templates,code,' . $template->id],
            'title' => ['required', 'string', 'max:255'],
            'html_template' => ['required', 'string'],
            'dynamic_fields' => ['required', 'array'],
            'dynamic_fields.*.name' => ['required', 'string'],
            'dynamic_fields.*.label' => ['required', 'string'],
            'dynamic_fields.*.type' => ['required', 'string', 'in:text,number,date,textarea,select'],
            'dynamic_fields.*.options' => ['nullable'],
            'dynamic_fields.*.required' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        foreach ($validated['dynamic_fields'] as &$field) {
            $field['required'] = !empty($field['required']);
            if (isset($field['options']) && is_string($field['options'])) {
                $field['options'] = array_map('trim', explode(',', $field['options']));
            } elseif (!isset($field['options']) || !is_array($field['options'])) {
                $field['options'] = [];
            }
        }

        $template->update($validated);

        return redirect()->route('templates.index')->with('success', 'Template SK berhasil diperbarui.');
    }

    /**
     * Remove the specified SK template from storage.
     */
    public function destroy(SkTemplate $template)
    {
        if ($template->submissions()->count() > 0) {
            return back()->with('error', 'Template tidak dapat dihapus karena sudah memiliki draf pengajuan terikat.');
        }

        $template->delete();

        return redirect()->route('templates.index')->with('success', 'Template SK berhasil dihapus.');
    }
}
