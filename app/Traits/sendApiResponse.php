<?php


namespace App\Traits;


trait sendApiResponse
{
    /**
     * @param string $data
     * @param string $message
     * @param string $errorType
     * @param array $extra
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendApiResponse($data = '', $message = 'success', $errorType = '', $extra = [], $code = null): \Illuminate\Http\JsonResponse
    {
        $response = [
                'message' => $message,
                'success' => $errorType == '' ? true : false,
                'error_type' => $errorType,
                'execution_time' => (double) number_format(microtime(true) - LARAVEL_START, 3),
            ] + $extra;
        if($data instanceof LengthAwarePaginator){
            $response += $data->toArray();
        }else{
            $response['data'] = $data;
        }
        $code = $code ?: 200;
        return response()->json($response, $code);
    }

}
