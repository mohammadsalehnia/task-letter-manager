<?php

namespace Modules\Letter\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Modules\Letter\App\Events\SendLetterEvent;
use Modules\Letter\App\Models\Letter;

class SendLetterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = [60, 60 * 10, 3600];

    /**
     * Create a new job instance.
     */
    public function __construct(public Letter $letter)
    {
//        $this->onQueue('sending-letter');

        Log::info('SendLetterJob __construct');

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('SendLetterJob');

        event(new SendLetterEvent($this->letter));
    }
}
