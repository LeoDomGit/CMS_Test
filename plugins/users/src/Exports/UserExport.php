<?php

namespace Leo\Users\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements  FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $users = DB::table('users')
            ->join('roles', 'users.idRole', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email','users.phone as Phone','roles.name as role',)
            ->get();

        return $users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Role',
        ];
    }
}
