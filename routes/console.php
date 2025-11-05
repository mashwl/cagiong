<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Lệnh mẫu có sẵn của Laravel
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// 🟢 Thêm phần này để tự publish bài khi đến lịch
Schedule::command('app:publish-scheduled-posts')->everyMinute();
