<?php

namespace App\Imports;

use App\Models\app_material;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAppMaterials implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new app_material([
            'book_name'    => $row[0], 
            'book_image'    => $row[1], 
            'publisher'    => $row[2], 
            'year'    => $row[3], 
            'book_pdf'    => $row[4], 
            'length'    => $row[5], 
            'summary'    => $row[6], 
            'tags'    => $row[7], 
            'language'    => $row[8], 
            'material_type'    => $row[9], 
            'genre_id'    => $row[10], 
            'department_id'    => $row[11], 
            'subject_id'    => $row[12], 
            'author'    => $row[13], 
        ]);
    }
}
