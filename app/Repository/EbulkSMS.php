<?php
/**
 * Created by Canaan Etai.
 * Date: 7/31/19
 * Time: 8:33 AM
 */

namespace App\Repository;


use App\Contracts\SMSContract;
use GuzzleHttp\Client;

class EbulkSMS implements SMSContract
{

    private $endpoint = 'sendsms.json';

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://api.ebulksms.com:80/',
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]);
    }

    /**
     * Send sms to a single recipient.
     *
     * @param $message
     * @param $recipient
     * @param $senderID
     * @return mixed
     */
    public function toOne($message, $recipient, $senderID = null)
    {
        $recipient = [
            "msidn" => $recipient,
            "msgid" => time().$recipient
        ];

        return $this->sendSMS($message, $recipient, $senderID);
    }

    /**
     * Send sms to multiple recipients
     *
     * @param $message
     * @param $recipients
     * @param $senderID
     * @return mixed
     */
    public function toMany($message, $recipients, $senderID = null)
    {
        $recipients = collect($recipients)->each(function ($recipient){
            return [
                "msidn" => $recipient,
                "msgid" => time().$recipient
            ];
        });

        return $this->  sendSMS($message, $recipients);
    }

    /**
     * Perform sending of sms to single / multiple recipient(s).
     *
     * @param $message
     * @param $recipients
     * @param $senderID
     * @return mixed
     */
    public function sendSMS($message, $recipients, $senderID = null)
    {
        $payload = collect([
            "SMS" => [
                "auth" => [
                    "username" => env("SMS_USERNAME"),
                    "apikey" => env('SMS_PASSWORD'),
                ],
                "message" => [
                    "sender" => $senderID ?? "IMELA",
                    "messagetext" => $message,
                    "flash" => '0'
                ],
                "recipients" => [
                    "gsm" => $recipients
                ]
            ]
        ])->toJson();

        $response = $this->client->post($this->endpoint,
            ['body' => $payload]
        );
        if ( $response->getStatusCode() == 200 ) {
//            dd(json_decode(substr($response->getBody()->getContents(), 3)));
            return $response->getBody()->getContents();
        }
    }
}
