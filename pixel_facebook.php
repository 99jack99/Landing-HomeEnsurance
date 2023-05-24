<?php

require __DIR__ . '/vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;



function setPixel($eventSourceUrl){
    $access_token = PIXEL_FACEBOOK_TOKEN;
    $pixel_id = PIXEL_FACEBOOK_ADS_ID;
    $event_id = PIXEL_FACEBOOK_EVENT_ID;



    $api = Api::init(null, null, $access_token);
    $api->setLogger(new CurlLogger());

    $user_data = (new UserData())   
        //->setClientIpAddress('80.80.80.50')
        ->setClientIpAddress($_SERVER['REMOTE_ADDR'])
        ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);

        /*
    $content = (new Content())
        ->setProductId('product123')
        ->setQuantity(1)
        ->setDeliveryCategory(DeliveryCategory::HOME_DELIVERY);

    $custom_data = (new CustomData())
        ->setContents(array($content))
        ->setCurrency('usd')
        ->setValue(123.45);
    */
    $event = (new Event())
        ->setEventName('CompleteRegistration')
        ->setEventId($event_id)
        ->setEventTime(time())
        //->setEventSourceUrl('https://sevibank.defensores-legales.es')
        ->setEventSourceUrl($eventSourceUrl)
        ->setUserData($user_data)    
        ->setActionSource(ActionSource::WEBSITE);

    $events = array();
    array_push($events, $event);

    $request = (new EventRequest($pixel_id))
        ->setEvents($events);        
    $response = $request->execute();   
}