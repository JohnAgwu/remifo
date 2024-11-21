<?php

namespace App\Repository;

use App\Models\Reminder;
use GuzzleHttp\Client;

class BulkSmsNigeria
{
    private string $endpoint = 'sms';

    protected $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.bulksmsnigeria.com/api/v2/',
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]);
    }
    public function sendSMS(Reminder $reminder, $phone)
    {

        $payload = collect([
            "body" => $reminder->body,
            "from" => $reminder->name,
            "to" => str($phone),
            "api_token" => env("BULK_SMS_TOKEN"),
            "gateway" => "direct-refund"
        ]);

        $response = $this->client->post($this->endpoint,
            ['body' => $payload]
        );

        if ( $response->getStatusCode() == 200 ) {
            return $response->getBody()->getContents();
        }
    }
}
