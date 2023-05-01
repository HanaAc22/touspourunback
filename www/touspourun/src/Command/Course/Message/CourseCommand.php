<?php

namespace App\Command\Course\Message;

use App\Entity\Category;
use App\Entity\Course;
use App\Form\Model\ContentFormModel;

class CourseCommand
{
    private Course $course;
    private Category $category;
    private readonly ContentFormModel $courseModel;

    public function __construct(Course $course, ContentFormModel $courseModel, Category $category)
    {
        $this->course = $course;
        $this->category = $category;
        $this->courseModel = $courseModel;
    }

    public function getCategories(): Course
    {
        return $this->course;
    }

    public function getCourses(): Category
    {
        return $this->category;
    }

    public function getCourseModel(): ContentFormModel
    {
        return $this->courseModel;
    }
}
