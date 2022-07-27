<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use App\Libraries\JsonResponseBuilder;

/**
 * Capture request and response json data
 */
class ApiResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);
        $original = $response->getOriginalContent();

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $code     = $response->getStatusCode();
            $original = (array)$original;
            if (isset($original['code'])) {
                $code = $original['code'];
            }
            $message = 'Error';
            if (!empty($original['message'])) {
                $message = $original['message'];
            }
            if ($code == 422) {
                $message = array_values($original['errors'])[0];
                $message = $message[0];
            }

            $original = JsonResponseBuilder::errorWithMessageAndData($code, $message, $original);
        } else {
            $message = $original['message'] ?? 'Success';
            $original = JsonResponseBuilder::success($original, $message);
        }

        $response->setContent($original->getContent());

        return $response;
    }
}
