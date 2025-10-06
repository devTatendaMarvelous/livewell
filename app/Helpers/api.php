<?php



define('MAX_EXECUTION_TIME', '600000000');

ini_set('max_execution_time', MAX_EXECUTION_TIME);

//$token =
function getRequest($url, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return @json_decode(json_encode(json_decode($response, false)));
}

function notificationRequest($url, $data = [])
{

        $url = env('NOTIFICATIONS_URL') . $url;
//        dd($url);
            $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $responseData = [
        'status' => $httpCode,
        'content' => json_decode($response, true),
    ];
    return json_decode(json_encode($responseData), false);

}
function postRequest($url, $data = [], $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }


    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));

}

function filePostRequest($url, $data, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }

    $file = $data['file'];
    $data['file'] = new CURLFile($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName());

    $token = session('token');
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: multipart/form-data',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));

}

function filePutRequest($url, $data, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }

    $file = $data['file'];
    $data['file'] = new CURLFile($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName());

    $token = session('token');
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: multipart/form-data',

            'Authorization: Bearer ' . $token

        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));

}

function putRequest($url, $data, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }
    $token = session('token');
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));
}

function deleteRequest($url, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }

    $token = session('token');
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));
}

function patchRequest($url, $data, $is_system = false)
{

    if ($is_system) {
        $url = env('SYSTEM_API_URL') . $url;
    }else{
        $url = env('API_URL') . $url;
    }
    $token = session('token');
    $curl = curl_init();
    curl_setopt_array(
        $curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return @json_decode(json_encode(json_decode($response, true)));
}


