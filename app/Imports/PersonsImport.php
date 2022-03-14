<?php

namespace App\Imports;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;

class PersonsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    
        $person = auth()->user()->id;
        dd($person);

    $row = $test = auth()->user()->id;

        return new Person([
            'user_id' => $row[0],
            'name'     => $row[1],
            'email'    => $row[2],
        ]);
    }
}
