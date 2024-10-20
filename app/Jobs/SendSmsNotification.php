<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SoapClient;

class SendSmsNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mobile;
    protected $textMessage;

    public function __construct($mobile, $textMessage)
    {
        $this->mobile = $mobile;
        $this->textMessage = $textMessage;
    }


    public function handle()
    {
        $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
        $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
        $webServiceNumber = "10004004040";

        mb_internal_encoding("utf-8");
        $textMessage = mb_convert_encoding($this->textMessage, "UTF-8");

        $parameters = [
            'signature' => $webServiceSignature,
            'from' => $webServiceNumber,
            'to' => [$this->mobile],
            'text' => $textMessage,
            'isFlash' =>  false,
            'udh' => "",
        ];
        try {
            $client = new SoapClient($webServiceURL);
            $response = (array)$client->SendGroupSmsSimple($parameters);
            \Log::info('SMS sent successfully: ' . $response['SendGroupSmsSimpleResult']);
        } catch (\SoapFault $ex) {
            \Log::error('SMS Send Error: ' . $ex->faultstring);
        }
    }















































































////تیکه جدید دیگر ولی جدید تر
//    protected $smsNotificationId;
//
//    public function __construct($smsNotificationId)
//    {
//        $this->smsNotificationId = $smsNotificationId;
//    }
//
//    public function handle()
//    {
//        $smsNotification = SmsNotification::find($this->smsNotificationId);
//        if (!$smsNotification) {
//            \Log::error('SMS Notification not found: ' . $this->smsNotificationId);
//            return;
//        }
//
//        $mobile = $smsNotification->recipient->user->mobile;
//        $textMessage = $smsNotification->text;
//
//        \Log::info('Starting SMS job for mobile: ' . $mobile);
//
//        $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//        $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//        $webServiceNumber = "10004004040"; // شماره ارسال پیامک
//        \Log::info($webServiceNumber);
//
//        mb_internal_encoding("utf-8");
//        $textMessage = mb_convert_encoding($textMessage, "UTF-8");
//
//        $parameters = [
//            'signature' => $webServiceSignature,
//            'from' => $webServiceNumber,
//            'to' => [$mobile],
//            'text' => $textMessage,
//            'isFlash' => false,
//            'udh' => "",
//        ];
//
//        try {
//            $client = new SoapClient($webServiceURL);
//            $response = (array)$client->SendGroupSmsSimple($parameters);
//            \Log::info('SMS sent successfully: ' . $response['SendGroupSmsSimpleResult']);
//        } catch (\SoapFault $ex) {
//            \Log::error('SMS Send Error: ' . $ex->faultstring);
//        }
//    }






























//    public function sendSms($mobile, $textMessage)
//    {
//        $webServiceURL  = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//        $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//        $webServiceNumber   = "10004004040"; // Message Sender Number
//
//        mb_internal_encoding("utf-8");
//        $textMessage = mb_convert_encoding($textMessage, "UTF-8");
//
//        $parameters = [
//            'signature' => $webServiceSignature,
//            'from' => $webServiceNumber,
//            'to' => [$mobile],
//            'text' => $textMessage,
//            'isFlash' => false, // Check if this is needed
//            'udh' => "", // If this is not required, you might try removing it
//        ];
//
//        try {
//            $client = new SoapClient($webServiceURL);
//            $response = (array)$client->SendGroupSmsSimple($parameters);
//            return $response['SendGroupSmsSimpleResult'];
//        } catch (\SoapFault $ex) {
//            \Log::error('SMS Send Error: ' . $ex->faultstring);
//        }
//    }


//    public function sendSms()
//    {
//        $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//        $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//        $webServiceNumber = "10004004040";
//        $Mobiles = array("09928458681", "09903594534");
//        mb_internal_encoding("utf-8");
//        $textMessage="hello World";
//        $textMessage= mb_convert_encoding($textMessage,"UTF-8");
//        $parameters['signature'] = $webServiceSignature;
//        $parameters['from' ]= $webServiceNumber;
//        $parameters['to' ]  = $Mobiles;
//        $parameters['text' ]=$textMessage;
//        $parameters[ 'isFlash'] = false;
//        $parameters['udh' ]= "";
//        try
//        {
//            $con = new SoapClient($webServiceURL);
//            $responseSTD = (array) $con ->SendGroupSmsSimple($parameters);
//            echo 'OutPut Method Value.............................=>';
//            echo '</br>';
//            echo  $responseSTD['SendGroupSmsSimpleResult'];
//        }
//        catch (SoapFault $ex)
//        {
//            echo $ex->faultstring;
//        }
//
//    }
}

