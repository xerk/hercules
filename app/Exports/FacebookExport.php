<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacebookExport implements FromCollection, WithHeadings
{
    protected $clients;
    private $fileName = 'clients.csv';
    private $writerType = Excel::CSV;
    private $headers = ['Content-Type' => 'application/json'];

    public function __construct($clients)
    {
        $this->clients = $clients;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->clients;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Email',
            'Username',
            'Religion',
            'Gender',
            'Work',
            'Position',
            'Hometown',
            'Education',
            'Nationality',
        ];
    }
}
