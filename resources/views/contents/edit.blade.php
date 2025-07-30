@extends('Layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Edit Content</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contents.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Content Title *</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title', $content->title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Video Source Type</label>
                <select name="video_source_type" class="form-select">
                    <option value="" {{ old('video_source_type', $content->video_source_type) == '' ? 'selected' : '' }}>Select Source</option>
                    <option value="youtube" {{ old('video_source_type', $content->video_source_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="vimeo" {{ old('video_source_type', $content->video_source_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                    <option value="dailymotion" {{ old('video_source_type', $content->video_source_type) == 'dailymotion' ? 'selected' : '' }}>Dailymotion</option>
                    <option value="other" {{ old('video_source_type', $content->video_source_type) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $content->video_url) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Video Length (minutes)</label>
                <input type="number" name="video_length" class="form-control" min="0" step="0.01" placeholder="e.g. 10.5" value="{{ old('video_length', $content->video_length) }}">
            </div>

            <button type="submit" class="btn btn-success">Update Content</button>
        </form>
    </div>
@endsection
