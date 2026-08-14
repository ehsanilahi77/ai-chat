<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ChatAgent;
use Illuminate\Http\Request;
use Laravel\Ai\Streaming\Events\TextDelta;

class StreamController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['message' => ['required', 'string', 'max: 2000']]);

        $message = $request->input('message');

        return response()->stream(function () use ($message) {

            try {
                $agent = new ChatAgent;
                $stream = $agent->stream($message);

                foreach ($stream as $event) {
                    if ($event instanceof TextDelta) {
                        echo 'data: '.json_encode([
                            'content' => $event->delta,
                        ])."\n\n";

                        ob_flush();
                        flush();
                    }
                }
            } catch (\Throwable $e) {
                report($e);

                echo 'data: '.json_encode([
                    'error' => 'Something went wrong. Please try again!',
                ])."\n\n";
            }

            echo "data: [DONE]\n\n";
            ob_flush();
            flush();

        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ]);

    }
}
