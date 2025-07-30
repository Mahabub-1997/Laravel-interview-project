<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Show the form to edit a module.
     */
    public function edit($id)
    {
        $module = Module::with('contents')->findOrFail($id); // Include contents
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the module and its contents.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'contents.*.title' => 'required|string|max:255',
            'contents.*.video_source_type' => 'nullable|string|max:255',
            'contents.*.video_url' => 'nullable|url',
            'contents.*.video_length' => 'nullable|numeric|min:0',
        ]);

        $module = Module::findOrFail($id);

        // Update module
        $module->update([
            'title' => $validated['title'],
        ]);

        // Remove old contents
        $module->contents()->delete();

        // Add new contents
        if (!empty($validated['contents'])) {
            foreach ($validated['contents'] as $contentData) {
                $module->contents()->create($contentData);
            }
        }

        return redirect()->route('courses.index', $module->id)
            ->with('success', 'Module updated successfully.');
    }
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->back()->with('success', 'Module deleted successfully!');
    }
}
