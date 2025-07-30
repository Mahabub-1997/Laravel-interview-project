<?php

namespace App\Repositories;

use App\Http\Requests\ModuleRequest;

class ModuleRepository
{

    protected $repo;

    public function __construct(ModuleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function edit($id)
    {
        $module = $this->repo->find($id);

        if (!$module) {
            abort(404, 'Module not found');
        }

        return view('modules.edit', compact('module'));
    }

    public function update(ModuleRequest $request, $id)
    {
        $validated = $request->validated();

        $this->repo->update($id, $validated);

        return redirect()->route('modules.edit', $id)
            ->with('success', 'Module updated successfully.');
    }
}
