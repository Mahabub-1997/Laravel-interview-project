<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentUpdateRequest;
use App\Models\Course;
use App\Repositories\ContentRepository;
use App\Models\Content;

class ContentController extends Controller
{
    protected $repo;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->repo = $contentRepository;
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $courses = Course::all();
        return view('contents.edit', compact('content', 'courses'));
    }

    public function update(ContentUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $content = $this->repo->update($id, $validated);

        return redirect()->route('courses.index', $content->id)
            ->with('success', 'Content updated successfully!');
    }
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return redirect()->back()->with('success', 'Content deleted successfully!');
    }
}
