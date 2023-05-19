<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = DB::table('users')
                ->selectRaw('id, name, email, password')
                ->get();
        return $users;
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'password'
        ];
    }
}
