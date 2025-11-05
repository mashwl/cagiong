<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Enums\PostStatus;
use Illuminate\Support\Carbon;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động đăng các bài viết đã được lên lịch khi đến thời gian scheduled_for';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Lấy các bài viết đang được lên lịch và đến thời gian đăng
        $scheduledPosts = Post::where('status', PostStatus::SCHEDULED)
            ->where('scheduled_for', '<=', $now)
            ->get();

        if ($scheduledPosts->isEmpty()) {
            $this->info('Không có bài viết nào cần đăng.');
            return;
        }

        foreach ($scheduledPosts as $post) {
            $post->update([
                'status' => PostStatus::PUBLISHED,
                'published_at' => $now,
            ]);
        }

        $this->info('✅ Đã đăng ' . $scheduledPosts->count() . ' bài viết được lên lịch.');
    }
}
