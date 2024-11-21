<?php

namespace App\Repository;

use App\Models\Reminder;
use Monolog\Logger;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class Infobip
{
    protected $client;
    private string $url = 'messages-api/1/messages';

    private array $destination = [];
    private array $messages = [];


    public function __construct()
    {

        $this->client = new Client([
            'base_uri' => 'https://l34635.api.infobip.com/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'App 492594d7a768d2e334098fa645b1c776-3ce26a30-5f65-4b84-b3ab-507952c3e3fb'
            ],
        ]);
    }


    public function sendSMS(Reminder $reminder, $phone)
    {

        foreach ($phone as $line){
            $this->destination[] = [
                'to' => trim($line, ' ')
            ];
        }

        $this->messages[] = [
            'channel' => 'SMS',
            'sender' => $reminder->user->name,
            'destinations' => $this->destination,
            'content' => [
                'body' => [
                    'text' => $reminder->body,
                    'type' => 'TEXT'
                ]
            ]
        ];

        $payload = collect([
            'messages' => $this->messages
        ])->toJson();

        $res = $this->client->post($this->url,  ['body' => $payload]);

        return $res;

//        if ($res->getStatusCode() == 200) {
//            return $res->getBody()->getContents();
//        }
    }
}
