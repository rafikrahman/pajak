<?php

namespace App\Http\Controllers;

use App\Export\ExportSetorbbm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        $perusahaanId = request('tableFilters.perusahaan_setorbbm_id.value');

        //return Excel::download(new ExportSetorbbm($perusahaanId), 'setorbbm.xlsx');

        //return "Hello Export Setorbbm: $perusahaanId";
    }
}
