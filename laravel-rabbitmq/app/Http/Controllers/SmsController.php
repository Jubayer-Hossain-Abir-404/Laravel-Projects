<?php

namespace App\Http\Controllers;

use App\Jobs\InsertSmsBatch;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function insertBatch(Request $request)
    {
        $count = (int) $request->query('count', 1000);
        $batch = (int) $request->query('batch', 100);

        for ($i = 0; $i < $count; $i += $batch) {
            $currentBatch = min($batch, $count - $i);
            InsertSmsBatch::dispatch($i, $currentBatch);
        }

        return response()->json(['message' => 'Batch jobs dispatched']);
    }
}
