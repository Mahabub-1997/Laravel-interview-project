
@extends('Layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Edit Module: {{ $module->title }}</h2>

         Show Validation Errors
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data" id="moduleForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Module Title *</label>
                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    required
                    value="{{ old('title', $module->title) }}"
                >
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h4>Contents</h4>
            <div id="contentsWrapper">
                @php
                    // Use old inputs if validation failed, otherwise load from DB
                    $contents = old('contents', $module->contents->toArray());
                @endphp

                @foreach($contents as $contentIndex => $content)
                    <div class="content-block border rounded p-3 mb-2">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>Content #{{ $contentIndex + 1 }}</strong>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.content-block').remove()">✖</button>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Content Title *</label>
                            <input
                                type="text"
                                name="contents[{{ $contentIndex }}][title]"
                                class="form-control @error("contents.$contentIndex.title") is-invalid @enderror"
                                required
                                value="{{ old("contents.$contentIndex.title", $content['title'] ?? '') }}"
                            >
                            @error("contents.$contentIndex.title")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Video Source Type</label>
                            <select
                                name="contents[{{ $contentIndex }}][video_source_type]"
                                class="form-select @error("contents.$contentIndex.video_source_type") is-invalid @enderror"
                            >
                                <option value="">Select Source</option>
                                @php
                                    $sources = ['youtube', 'vimeo', 'dailymotion', 'other'];
                                    $selectedSource = old("contents.$contentIndex.video_source_type", $content['video_source_type'] ?? '');
                                @endphp
                                @foreach($sources as $source)
                                    <option value="{{ $source }}" @if($selectedSource === $source) selected @endif>
                                        {{ ucfirst($source) }}
                                    </option>
                                @endforeach
                            </select>
                            @error("contents.$contentIndex.video_source_type")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Video URL</label>
                            <input
                                type="url"
                                name="contents[{{ $contentIndex }}][video_url]"
                                class="form-control @error("contents.$contentIndex.video_url") is-invalid @enderror"
                                value="{{ old("contents.$contentIndex.video_url", $content['video_url'] ?? '') }}"
                            >
                            @error("contents.$contentIndex.video_url")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Video Length (minutes)</label>
                            <input
                                type="number"
                                name="contents[{{ $contentIndex }}][video_length]"
                                class="form-control @error("contents.$contentIndex.video_length") is-invalid @enderror"
                                min="0" step="0.01" placeholder="e.g. 10.5"
                                value="{{ old("contents.$contentIndex.video_length", $content['video_length'] ?? '') }}"
                            >
                            @error("contents.$contentIndex.video_length")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-outline-primary my-3" onclick="addContent()">+ Add New Content</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Update Module</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let contentIndex = {{ count($contents) }};

        function addContent() {
            const wrapper = document.getElementById('contentsWrapper');
            const contentDiv = document.createElement('div');
            contentDiv.classList.add('content-block', 'border', 'rounded', 'p-3', 'mb-2');
            contentDiv.innerHTML = `
            <div class="d-flex justify-content-between mb-2">
                <strong>Content #${contentIndex + 1}</strong>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.content-block').remove()">✖</button>
            </div>

            <div class="mb-2">
                <label class="form-label">Content Title *</label>
                <input type="text" name="contents[${contentIndex}][title]" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Video Source Type</label>
                <select name="contents[${contentIndex}][video_source_type]" class="form-select">
                    <option value="">Select Source</option>
                    <option value="youtube">YouTube</option>
                    <option value="vimeo">Vimeo</option>
                    <option value="dailymotion">Dailymotion</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label">Video URL</label>
                <input type="url" name="contents[${contentIndex}][video_url]" class="form-control">
            </div>

            <div class="mb-2">
                <label class="form-label">Video Length (minutes)</label>
                <input type="number" name="contents[${contentIndex}][video_length]" class="form-control" min="0" step="0.01" placeholder="e.g. 10.5">
            </div>
        `;
            wrapper.appendChild(contentDiv);
            contentIndex++;
        }
    </script>
@endsection
