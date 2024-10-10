<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FormCollection;
use App\Models\Setorbbm;
use Maatwebsite\Excel\Facades\Excel;

class ExportSetorbbm implements FormCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Setorbbm::where('perusahaan_setorbbm_id', $this->id)->get();
    }
}
