<?php

namespace App\Filament\Widgets;

use App\Models\Target;
use App\Models\Setorbbm;
use Illuminate\Support\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;


class StatsOverviewBbm extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {

        //$startDate = is_null($this->filters['startDate']) ? now()->startOfMonth() : Carbon::parse($this->filters['startDate']);

        //$endDate = is_null($this->filters['endDate']) ? now()->endOfMonth() : Carbon::parse($this->filters['endDate']);

        $realisasi = Setorbbm::get()->sum('nilai');

        //$realisasi = Setorbbm::expenses()
                    //->whereBetween('tglsetor', [$startDate, $endDate])
                    //->sum('nilai');

        $target = (1000899422704);

        return [
            Stat::make('Target PBB KB', 'Rp. ' . formatRupiah($target)),
            Stat::make('Realisasi PBB KB', 'Rp. ' . formatRupiah($realisasi)),
            Stat::make('Capaian PBB KB', formatDesimal($realisasi / $target * 100) . '%'),
        ];

    }
}
