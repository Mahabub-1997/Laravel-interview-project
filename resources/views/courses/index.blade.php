@extends('Layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">All Courses</h2>

        @if($courses->isEmpty())
            <p>No courses found.</p>
        @else
            <div class="accordion" id="coursesAccordion">
                @foreach($courses as $courseIndex => $course)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="headingCourse{{ $courseIndex }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCourse{{ $courseIndex }}" aria-expanded="false" aria-controls="collapseCourse{{ $courseIndex }}">
                                {{ $course->title }}
                            </button>
                        </h2>
                        <div id="collapseCourse{{ $courseIndex }}" class="accordion-collapse collapse" aria-labelledby="headingCourse{{ $courseIndex }}" data-bs-parent="#coursesAccordion">
                            <div class="accordion-body">
                                <p><strong>Description:</strong> {{ $course->description ?? 'N/A' }}</p>
                                <p><strong>Category:</strong> {{ $course->category ?? 'N/A' }}</p>

                                <div class="mb-3">
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit Course</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete Course</button>
                                    </form>
                                </div>

                                @if($course->modules->isEmpty())
                                    <p class="text-muted">No modules available for this course.</p>
                                @else
                                    <div class="accordion" id="modulesAccordion{{ $courseIndex }}">
                                        @foreach($course->modules as $moduleIndex => $modules)
                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header" id="headingModule{{ $courseIndex }}{{ $moduleIndex }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModule{{ $courseIndex }}{{ $moduleIndex }}" aria-expanded="false" aria-controls="collapseModule{{ $courseIndex }}{{ $moduleIndex }}">
                                                        📘 {{ $modules->title }}
                                                    </button>
                                                </h2>
                                                <div id="collapseModule{{ $courseIndex }}{{ $moduleIndex }}" class="accordion-collapse collapse" aria-labelledby="headingModule{{ $courseIndex }}{{ $moduleIndex }}" data-bs-parent="#modulesAccordion{{ $courseIndex }}">
                                                    <div class="accordion-body">
                                                        <div class="mb-3">
                                                            <a href="{{ route('modules.edit', $modules->id) }}" class="btn btn-sm btn-warning">Edit Module</a>
                                                            <form action="{{ route('modules.destroy', $modules->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this module?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger">Delete Module</button>
                                                            </form>
                                                        </div>

                                                        @if($modules->contents->isEmpty())
                                                            <p class="text-muted">No contents available in this module.</p>
                                                        @else
                                                            <ul class="list-group">
                                                                @foreach($modules->contents as $content)
                                                                    <li class="list-group-item">
                                                                        <strong>{{ $content->title }}</strong><br>
                                                                        @if($content->video_source_type)
                                                                            <small>Source: {{ ucfirst($content->video_source_type) }}</small><br>
                                                                        @endif
                                                                        @if($content->video_url)
                                                                            <small>URL: <a href="{{ $content->video_url }}" target="_blank">{{ $content->video_url }}</a></small><br>
                                                                        @endif
                                                                        @if($content->video_length)
                                                                            <small>Duration: {{ $content->video_length }} minutes</small>
                                                                        @endif

                                                                        <div class="mt-2">
                                                                            <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-sm btn-warning">Edit Content</a>
                                                                            <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this content?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="btn btn-sm btn-danger">Delete Content</button>
                                                                            </form>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
