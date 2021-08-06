<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'dni' => 'required',
            'apellidos' => 'required',
            'nombre' => 'required',
            'email' => 'required',
            'celular' => 'required',
        ];
    }
    public function model(array $rows)
    {

        return $rows;
    }
}
