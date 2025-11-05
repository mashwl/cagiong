<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Biểu đồ đơn hàng';
    protected int|string|array $columnSpan = '2';
    protected static ?string $maxHeight = '200px';


    protected function getFilters(): ?array
    {
        return [
            'month' => 'Tháng này',
            'year' => 'Năm nay',
        ];
    }

    protected function getData(): array
    {
        // --- Xác định ngày bắt đầu & kết thúc dựa trên filter ---
        $filter = $this->filter ?? 'month'; // mặc định là tháng này

        if ($filter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
            $period = 'perMonth';
        } else {
            // mặc định: tháng này
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $period = 'perDay';
        }

        // --- Lấy dữ liệu thống kê ---
        $data = Trend::model(Order::class)
            ->between(
                start: $startDate,
                end: $endDate
            )
            ->{$period}()
            ->count();

        // --- Trả về dữ liệu biểu đồ ---
        return [
            'datasets' => [
                [
                    'label' => 'Số lượng đơn hàng',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.3)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
