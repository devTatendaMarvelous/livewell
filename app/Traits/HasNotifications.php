<?php

namespace App\Traits;

use App\Traits\HasCurlRequests;

trait HasNotifications
{

    private $url = 'http://167.86.88.166:9104/notification-service/emails/send';
    use HasCurlRequests;

    public function emailNotification($emails,$subject,$body,$attachment=null)
    {
        $emails=collect($emails);
        $emails->each(function ($email) use ($body,$subject) {
            $data =  [
                "emails" => [
                    [
                        "receipient" => [
                            "email" => $email
                        ],
                        "subject" => $subject,
                        "bodyText" => $body
                    ]
                ]
            ];

            $this->postRequest($this->url, $data);
        });


    }

    public function generateClaimChargeBody( $data)
    {
        return"
    <p>Dear Claims Team</p>
    <p>Client $data->client has submitted a New Claim with the details below :</p>
    <ul>
        <li>Claim Reference: $data->id</li>
        <li>Case type: Civil Case</li>
        <li>Nature of Case: $data->nature_of_case </li>
        <li>Charge Name: $data->charge_name </li>
        <li>Amount: $data->amount</li>
        <li>Currency: $data->currency </li>
        <li>Status: $data->status </li>
    </ul>
    <p>Please attend to claim promptly by clicking on the link below:</p>

    <a href='https://coverlink.logarithm.co.zw/claim-view/$data->id'>Review New Clam<a>";

//
//        "<p>Good day,</p>
//<p>A claim charge has been processed with the following details, please process the claim.</p>
//<ul>
//    <li>Claim Reference: $data->id </li>
//    <li>Charge Name: $data->charge_name </li>
//    <li>Amount: $data->amount </li>
//    <li>Currency: $data->currency </li>
//    <li>Status: $data->status </li>
//</ul>
//<p>Thank you for your attention.</p>";

    }

}
