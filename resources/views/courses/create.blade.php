
@extends('Layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Create New Course</h2>

        {{-- Show Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Course Title *</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control">
            </div>

            <hr>
            <h4>Modules</h4>
            <div id="modulesWrapper">
                <!-- Modules will be added here -->
            </div>

            <button type="button" class="btn btn-outline-primary my-3" onclick="addModule()">+ Add New Module</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Save Course</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let moduleIndex = 0;

        function addModule() {
            const wrapper = document.getElementById('modulesWrapper');
            const moduleDiv = document.createElement('div');
            moduleDiv.classList.add('card', 'mb-3');
            moduleDiv.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Module</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="this.closest('.card').remove()"></button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Module Title *</label>
                    <input type="text" name="modules[${moduleIndex}][title]" class="form-control" required>
                </div>

                <div class="contentsWrapper mb-3">
                    <!-- Contents will go here -->
                </div>

                <button type="button" class="btn btn-sm btn-secondary" onclick="addContent(this, ${moduleIndex})">+ Add Content</button>
            </div>
        `;
            wrapper.appendChild(moduleDiv);
            moduleIndex++;
        }

        function addContent(button, modIndex) {
            const contentWrapper = button.closest('.card-body').querySelector('.contentsWrapper');
            const contentIndex = contentWrapper.querySelectorAll('.content-block').length;
            const contentDiv = document.createElement('div');
            contentDiv.classList.add('content-block', 'border', 'rounded', 'p-3', 'mb-2');
            contentDiv.innerHTML = `
            <div class="d-flex justify-content-between mb-2">
                <strong>Content</strong>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.content-block').remove()">✖</button>
            </div>

            <div class="mb-2">
                <label class="form-label">Content Title *</label>
                <input type="text" name="modules[${modIndex}][contents][${contentIndex}][title]" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Video Source Type</label>
                <select name="modules[${modIndex}][contents][${contentIndex}][video_source_type]" class="form-select">
                    <option value="">Select Source</option>
                    <option value="youtube">YouTube</option>
                    <option value="vimeo">Vimeo</option>
                    <option value="dailymotion">Dailymotion</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label">Video URL</label>
                <input type="url" name="modules[${modIndex}][contents][${contentIndex}][video_url]" class="form-control">
            </div>

            <div class="mb-2">
                <label class="form-label">Video Length (minutes)</label>
                <input type="number" name="modules[${modIndex}][contents][${contentIndex}][video_length]" class="form-control" min="0" step="0.01" placeholder="e.g. 10.5">
            </div>
        `;
            contentWrapper.appendChild(contentDiv);
        }
    </script>
@endsection
