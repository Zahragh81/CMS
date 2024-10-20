<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    $name = 'احمد علی بی خویش';
//
//    $query = \App\Models\User::select(['id', 'username', 'first_name', 'last_name']);
//
//    $array = explode(' ', $name);
//
//    foreach ($array as $search)
//        $query->whereAny(['username', 'first_name', 'last_name'], 'like', "%$search%");
//});
//Route::get('/send-sms', function () {
//    $webServiceURL  = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//    $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//    $webServiceNumber   = "10004004040";
//    $Mobiles      = array ("09928458681", "0938485943");
//    mb_internal_encoding("utf-8");
//    $textMessage="hello World";
//    $textMessage= mb_convert_encoding($textMessage,"UTF-8");
//    $parameters['signature'] = $webServiceSignature;
//    $parameters['from' ]= $webServiceNumber;
//    $parameters['to' ]  = $Mobiles;
//    $parameters['text' ]=$textMessage;
//    $parameters[ 'isFlash'] = false;
//    $parameters['udh' ]= "";
//    try
//    {
//        $con = new SoapClient($webServiceURL);
//        $responseSTD = (array) $con ->SendGroupSmsSimple($parameters);
//        echo 'OutPut Method Value.............................=>';
//        echo '</br>';
//        echo  $responseSTD['SendGroupSmsSimpleResult'];
//    }
//    catch (SoapFault $ex)
//    {
//        echo $ex->faultstring;
//    }
//});

//Route::get('/sendSms', function (){
//    $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//    $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//    $webServiceNumber = "10004004040";
//    $mobile = "09928458681";
//    $textMessage = "این یک پیام تستی است";
//
//    mb_internal_encoding("utf-8");
//    $textMessage = mb_convert_encoding($this->textMessage, "UTF-8");
//
//    $parameters = [
//        'signature' => $webServiceSignature,
//        'from' => $webServiceNumber,
//        'to' => [$mobile],
//        'text' => $textMessage,
//        'isFlash' =>  false,
//        'udh' => "",
//    ];
//    try {
//        $client = new SoapClient($webServiceURL);
//        $response = (array)$client->SendGroupSmsSimple($parameters);
//        \Log::info('SMS sent successfully: ' . $response['SendGroupSmsSimpleResult']);
//    } catch (\SoapFault $ex) {
//        \Log::error('SMS Send Error: ' . $ex->faultstring);
//    }
//});

//Route::get('/sendSms', function () {
//    $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
//    $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
//    $webServiceNumber = "10004004040";
//
//    $mobile = "09928458681";
//    $textMessage = "این یک پیامک تست است.";
//
//    mb_internal_encoding("utf-8");
//    $textMessage = mb_convert_encoding($textMessage, "UTF-8");
//
//    $parameters = [
//        'signature' => $webServiceSignature,
//        'from' => $webServiceNumber,
//        'to' => [$mobile],
//        'text' => $textMessage,
//        'isFlash' => false,
//        'udh' => "",
//    ];
//
//    try {
//        $client = new SoapClient($webServiceURL);
//        $response = (array)$client->SendGroupSmsSimple($parameters);
//        \Log::info('SMS sent successfully: ' . $response['SendGroupSmsSimpleResult']);
//    } catch (\SoapFault $ex) {
//        \Log::error('SMS Send Error: ' . $ex->faultstring);
//    }
//});



Route::get('/', function (){
    \App\Jobs\SlowJob::dispatch();
   return view('welcome');
});
