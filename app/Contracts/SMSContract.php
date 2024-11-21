<?php
/**
 * Created by Canaan Etai.
 * Date: 7/31/19
 * Time: 8:31 AM
 */

namespace App\Contracts;


interface SMSContract
{
    /**
     * Send sms to a single recipient.
     *
     * @param $message
     * @param $recipient
     * @param $senderID
     * @return mixed
     */
    public function toOne($message, $recipient, $senderID = null);

    /**
     * Send sms to multiple recipients
     *
     * @param $message
     * @param $recipients
     * @param $senderID
     * @return mixed
     */
    public function toMany($message, $recipients, $senderID = null);

    /**
     * Perform sending of sms to single / multiple recipient(s).
     *
     * @param $message
     * @param $recipients
     * @param $senderID
     * @return mixed
     */
    public function sendSMS($message, $recipients, $senderID = null);

}