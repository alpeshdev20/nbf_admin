<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'teacher_name' => $this->teacher_name,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'inst_name' => $this->inst_name,
            'department' => $this->department,
            'designation' => $this->designation,
            'sub_taught' => $this->sub_taught,
            'resource_planing' => $this->resource_planing,
            'teaching_resource' => $this->teaching_resource,
            'student_strength' => $this->student_strength
        ];
    }
}
