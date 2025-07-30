<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class CourseRepository
{
    public function createCourseWithModules(array $data)
    {
        return DB::transaction(function() use ($data) {
            $course = Course::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'category' => $data['category'] ?? null,
            ]);

            if (!empty($data['modules'])) {
                foreach ($data['modules'] as $moduleData) {
                    $module = $course->modules()->create([
                        'title' => $moduleData['title'],
                    ]);

                    if (!empty($moduleData['contents'])) {
                        foreach ($moduleData['contents'] as $contentData) {
                            $module->contents()->create([
                                'title' => $contentData['title'],
                                'video_source_type' => $contentData['video_source_type'] ?? null,
                                'video_url' => $contentData['video_url'] ?? null,
                                'video_length' => $contentData['video_length'] ?? null,
                            ]);
                        }
                    }
                }
            }

            return $course;
        });
    }
    public function findWithModulesAndContents($id)
    {
        return Course::with('modules.contents')->findOrFail($id);
    }

    public function find($id)
    {
        return Course::findOrFail($id);
    }

}
