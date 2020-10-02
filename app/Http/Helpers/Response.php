<?php
function successResponseWithData($data, $message = null)
{
    $data = [
        'status' => 'success',
        'message' => $message,
        'data' => $data,
    ];

    return response()->json($data, 200);
}

function validationErrors($errors, $message = null)
{
    $data = [
        'status' => 'validations',
        'message' => (empty($message)) ? __('response.invalid_data') : $message,
        'errors' => $errors,
    ];

    return response()->json($data, 422);
}
