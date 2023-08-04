<?php

if (!function_exists('validateError')) {
    function validateError($data,$override = false)
    {
        $errors = [];
        $errorPayload = !$override ? $data->getMessages() : $data;

        foreach ($errorPayload as $key => $value) {
            $errors[$key] = $value[0];
        }

        return response(['status' => 'validate_error', 'statusCode' => 422, 'data' => $errors], 422);

}
}
