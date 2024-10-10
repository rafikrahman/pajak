<?php

namespace App\Filament\Widgets;

use App\Models\Target;
use App\Models\Setorbbm;
use App\Models\Setorpr;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use Squire\Models\Currency;

class StatsOverviewPr extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {

        // $startDate = ! is_null($this->filters['startDate'] ?? null) ?
        //     Carbon::parse($this->filters['startDate']) :
        //     null;

        // $endDate = ! is_null($this->filters['endDate'] ?? null) ?
        //     Carbon::parse($this->filters['endDate']) :
        //     now();

        $realisasi = Setorpr::get()->sum('nilai');
        $target = (222818168442);

        return [
            Stat::make('Target Pajak Rokok', 'Rp. ' . formatRupiah($target)),
            Stat::make('Realisasi Pajak Rokok', 'Rp. ' . formatRupiah($realisasi)),
            Stat::make('Capaian Pajak Rokok', formatDesimal($realisasi / $target * 100) . '%'),
        ];

    }
}
