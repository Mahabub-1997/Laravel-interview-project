<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseRepo;
    protected $repo;

    public function create()
    {
        return view('courses.create');
    }
    public function __construct(
        CourseRepository $courseRepo,

    ) {
        $this->repo = $courseRepo;

    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->courseRepo->createCourseWithModules($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }
    public function index()
    {
        $courses = Course::with('modules.contents')->get();
        return view('Courses.index', compact('courses'));
    }


    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index', $course->id)
            ->with('success', 'Course updated successfully!');
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }


}
