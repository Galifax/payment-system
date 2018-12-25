<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\{
    Exportable,
    FromCollection,
    WithHeadings,
    WithMapping  
};

class UserExport implements FromCollection {

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function collection()
    {
        return $this->user;
    }

    public function map($user): array
    {
        return [ 
            'name' => $user->name,            
        ];
    }
}
