<?php

namespace App\Exports;

use App\Models\ModelServicos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;

class ServicosFromView implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelServicos::all();

    }
}
