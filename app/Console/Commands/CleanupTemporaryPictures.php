<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class CleanupTemporaryPictures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-temporary-pictures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredPictures = Picture::where('is_temporary', true)->where('created_at', '<', now()->subHours(1))->get();

        foreach ($expiredPictures as $picture) {
            Storage::delete('public/' . $picture->path);
            $picture->delete();
        }
    }
}
