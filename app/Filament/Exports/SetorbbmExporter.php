<?php

namespace App\Filament\Exports;

use App\Models\Setorbbm;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SetorbbmExporter extends Exporter
{
    protected static ?string $model = Setorbbm::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('perusahaan.name')
                ->label('Perusahaan'),
            ExportColumn::make('regency.name')
                ->label('Kabupaten/Kota'),
            ExportColumn::make('volume'),
            ExportColumn::make('nilai'),
            ExportColumn::make('tglsetor')
                ->label('Tanggal Setor'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your setorbbm export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
