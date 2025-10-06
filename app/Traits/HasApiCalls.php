<?php

namespace App\Traits;

define("MAX_EXECUTION_TIME", "600000000");

ini_set('max_execution_time', MAX_EXECUTION_TIME);
trait HasApiCalls
{
    function getRequest($url,$is_download=null)
    {
        if ($is_download){

            $url = env('CONTABO_SERVICE') . $url;
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
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
                'X-API-KEY: '.xapikey()
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return @json_decode(json_encode(json_decode($response, false)));
    }

    function postRequest($url, $data = [], $is_login = false)
    {
        if (!$is_login) {
            $url = env('API_URL') . $url;
        }
//dd(json_encode( $data));
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

    function filePostRequest($url, $data)
    {

        $file = $data['file'];
        $data['file'] = new CURLFile($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName());

        $token = session('token');
        $url = env('API_URL') . $url;
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

    function filePutRequest($url, $data)
    {

        $file = $data['file'];
        $data['file'] = new CURLFile($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName());

        $token = session('token');
        $url = env('API_URL') . $url;
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

    function putRequest($url, $data)
    {
        $url = env('API_URL') . $url;
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

    function deleteRequest($url)
    {
        $url = env('API_URL') . $url;

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

    function patchRequest($url, $data)
    {
        $url = env('API_URL') . $url;
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

}
