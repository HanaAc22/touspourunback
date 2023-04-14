<?php

namespace App\Command\Course\Message;

use App\Entity\Course;
use App\Form\Model\ContentFormModel;

class CourseCommand
{
    private Course $course;
    private readonly ContentFormModel $courseModel;

    public function __construct(Course $course, ContentFormModel $courseModel)
    {
        $this->course = $course;
        $this->courseModel = $courseModel;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getCourseModel(): ContentFormModel
    {
        return $this->courseModel;
    }
}