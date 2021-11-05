<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromCollection, WithHeadings
{
    use Exportable;
    
    protected $result;
    
    private $writerType = Excel::CSV;
    private $headers = ['Content-Type' => 'application/json'];

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function collection()
    {
        return collect($this->result);
    }

    public function headings(): array
    {
        return [
            'facebook ID',
            'Mobile',
            'Username',
            'Name',
            'Religion',
            'Birthday',
            'Gender',
            'Work',
            'Position',
            'Hometown',
            'Location',
            'Education',
            'Relationship',
            'Country',
        ];
    }
}
