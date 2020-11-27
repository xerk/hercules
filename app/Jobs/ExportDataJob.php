<?php

namespace App\Jobs;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $clients;
    private $file;
    private int $id;
    private array $result;

    public function __construct($clients, $file , int $id)
    {
        $this->clients = $clients;
        $this->file = $file;
        $this->id = $id;
    }

    public function handle()
    {
        $this->chunk();

        $this->saveResult();

    }

    private function saveResult()
    {
        if ($this->result > 0) {
            Excel::queue(new UsersExport($this->clients, $this->file), $this->file)->chain([
                new ExportJob($this->result, $this->file, auth()->user()->id),
            ]);
            User::find(auth()->user()->id)->decrement('point', ($this->result));
        }
    }

    private function chunk()
    {
        DB::table('clients')
            ->orderBy('id')
            ->where('id', '>', $this->id)
            ->whereIn('unique_id', $this->clients)
            ->chunk(100, function ($results) {
                $this->updateResults($results);
            });
    }

    private function updateResults($results)
    {
        foreach ($results as $result) {

            $this->result[] = $result;
        }
        $this->id += 100;
    }
}
