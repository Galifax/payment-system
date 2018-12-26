<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\{
    Exportable,
    FromCollection,
    WithHeadings,
    WithMapping  
};

class UserExport implements FromCollection, WithMapping, WithHeadings {

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $user;

    public function __construct($user) {
        $this->user = $user->operations;
        $this->model = $user;
    }

    public function collection()
    {
        return $this->user;
    }

    public function map($user): array
    {
        return [ 
            'created_at' => $user['created_at'], 
            'user' => $user['user']['name'],
            'summ' => $user['summ'] . ' ' . $this->model['currency']['code'],                           
            'operation' => $user['operation'],            
            'conversion' => $user['conversion'] . ' ' . $user['user']['currency']['code'],                           
        ];
    }

    public function headings(): array
    {
        return [
            'Дата',
            'Получатель',
            'Колисество',
            'Действие',
            'Конвертация'
        ];
    }
}
