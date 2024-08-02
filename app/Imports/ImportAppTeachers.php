<?php

namespace App\Imports;

use App\Models\TeacherDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportAppTeachers implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     dd($row['email']);
    //     return new TeacherDetail([
    //         'teacher_name'    => $row['teacher_name'] ? $row['teacher_name'] : 'N/A', 
    //         'mobile_no'    => $row['mobile_no'], 
    //         'email'    => $row['email'], 
    //         'institute_name'    => $row['institute_name'], 
    //         'department'    => $row['department'], 
    //         'designation'    => $row['designation'], 
    //         'subject_taught'    => $row['subject_taught'], 
    //         'resource_planning'    => $row['resource_planning'], 
    //         'teaching_resource'    => $row['teaching_resource'], 
    //         'student_strength'    => (isset($row['student_strength']) ? $row['student_strength'] : 0), 
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        // echo "<pre>";
        // print_r($rows);
        // echo "</pre>";
        // exit;
        foreach ($rows as $row) 
        {
            if (!empty($row['email'])) {
                 TeacherDetail::create([
                    'teacher_name' => $row['teacher_name'],
                    'mobile_no'    => $row['mobile_no'], 
                    'email'    => $row['email'],
                    'institute_name'    => $row['inst_name'], 
                    'department'    => $row['department'], 
                    'designation'    => $row['designation'], 
                    'subject_taught'    => $row['sub_taught'], 
                    'resource_planning'    => (!empty($row['resource_planning']) ? $row['resource_planning'] : ''), 
                    'teaching_resource'    => (!empty($row['teaching_resource']) ? $row['teaching_resource'] : ''),
                    'student_strength'    => (!empty($row['student_strength']) ? $row['student_strength'] : 0),
                ]);
            }
           
        }
    }
}
