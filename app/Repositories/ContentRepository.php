<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    public function update($id, array $data)
    {
        $content = Content::findOrFail($id);

        $content->update([
            'title' => $data['title'],
            'video_source_type' => $data['video_source_type'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'video_length' => $data['video_length'] ?? null,
        ]);

        return $content;
    }
}
