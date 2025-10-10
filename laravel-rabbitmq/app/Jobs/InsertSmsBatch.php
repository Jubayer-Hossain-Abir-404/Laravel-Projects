<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertSmsBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(protected int $start, protected int $count)
    {

    }

    public function handle()
    {
        $batchArgs = [];
        for ($i = 0; $i < $this->count; $i++) {
            $batchArgs[] = [
                'brand_id' => '1',
                'phone_number' => '8801' . rand(100000000, 999999999),
                'message' => 'Hello ' . ($this->start + $i),
                'status' => 'PENDING'
            ];
        }

        DB::table('sms_logs')->insert($batchArgs);
    }
}
