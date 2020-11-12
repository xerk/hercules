<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Client;
use App\Models\Export;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $path;
    protected $clients;
    private $fileName = 'users.csv';
    private $writerType = Excel::CSV;
    private $headers = ['Content-Type' => 'application/json'];


    public function __construct(array $clients, $path)
    {
        $this->clients = $clients;
        $this->path = $path;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {  
        // return Client::whereIn('unique_id', $this->clients)->get()->map(function ($user) {
        //     return [
        //         'id' => $this->decode($user->unique_id),
        //         'mobile' => $this->decode($user->mobile),
        //         'nationality' => $user->nationality,
        //     ];
        // });
        return Client::query()->whereIn('unique_id', $this->clients)->select('unique_id', 'mobile', 'nationality')->orderBy('unique_id');
    }

    private function decode($ids)
    {
        $encode   = ["h", "m", "e", "p", "#", "s", "%", "b", "o", "r", "$"];
        $decode = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+"];
        return str_replace($encode, $decode, $ids);
    }

    public function headings(): array
    {
        return [
            'facebook ID',
            'Mobile',
            'Country',
        ];
    }
}
