<?php

namespace App\Libraries;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;
use Exception;

class SendPushNotification
{
    public function sendVoipToDeviceV2($deviceToken, $data)
    {
        // $deviceToken = '1512536c5ce479dbd86ef21b1af6307ca96fc80886d630f13e9ce95e15b15f40';
        try {
            if (!defined('CURL_HTTP_VERSION_2_0')) {
                define('CURL_HTTP_VERSION_2_0', 3);
            }
            // open connection
            $http2ch = curl_init();
            curl_setopt($http2ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

            $body['data'] = $data;
            $body['aps']  = array(
                'content-available' => 1,
                'alert'             => '',
                'sound'             => 'default',
                'badge'             => 0
            );
            // Encode the payload as JSON
            $payload = json_encode($body);

            // send push
            $apple_cert = resource_path('config/newfile.pem');
            // $message = '{"aps":{"action":"message","title":"your_title","body":"your_message_body"}}';
            $http2_server = 'https://api.development.push.apple.com'; // or 'api.push.apple.com' if production
            if (env('APP_ENV') === 'development') {
                $http2_server = 'https://api.push.apple.com';
            }

            $app_bundle_id = 'jp.co.cocoron.voip';

            $url  = "{$http2_server}/3/device/{$deviceToken}";
            $cert = realpath($apple_cert);
            // headers
            $headers = array(
                "apns-topic: {$app_bundle_id}",
                "User-Agent: My Sender"
            );
            curl_setopt_array($http2ch, array(
                CURLOPT_URL            => $url,
                CURLOPT_PORT           => 443,
                CURLOPT_HTTPHEADER     => $headers,
                CURLOPT_POST           => TRUE,
                CURLOPT_POSTFIELDS     => $payload,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSLCERT        => $cert,
                CURLOPT_HEADER         => 1
            ));
            $result = curl_exec($http2ch);
            if ($result === FALSE) {
                throw new Exception("Curl failed: " . curl_error($http2ch));
            }
            // get response
            $status = curl_getinfo($http2ch, CURLINFO_HTTP_CODE);
            if ($status == "200")
                \Log::info('Message successfully delivered: ' . $deviceToken);
            else
                \Log::info('Message not delivered');
            // close connection
            curl_close($http2ch);
            \Log::info('----------------------SUCCESS---------------------------');
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }

    }

    public function sendVoipToDevice($deviceToken, $data, $type = 0)
    {
        try {
            $server = 'ssl://gateway.sandbox.push.apple.com:2195';
            // if (env('APP_ENV', 'local') === 'production') {
            //     $server = 'ssl://gateway.push.apple.com:2195';
            // }
            $passphrase = '';

            $config_pem = resource_path('config/voippushcert.pem');
            $ctx        = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $config_pem);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
            // stream_context_set_option($ctx , 'ssl', 'verify_peer', false);
            // stream_context_set_option($ctx , 'ssl', 'apns-expiration', 0);
            // stream_context_set_option($ctx , 'ssl', 'apns-priority', 10);

            // Open a connection to the APNS server
            $fp = stream_socket_client(
                $server, $err,
                $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
            if (!$fp) {
                throw new \Exeption("Failed to connect: $err $errstr", 500);
            }
            \Log::info('Connected to APNS');
            // Create the payload body
            $body['data'] = $data;
            $body['aps']  = array(
                'content-available' => 1,
                'alert'             => '',
                'sound'             => 'default',
                'badge'             => 0
            );
            // Encode the payload as JSON
            $payload = json_encode($body);
            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
            if (!$result) {
                \Log::info('Message not delivered');
            } else {
                \Log::info('Message successfully delivered: ' . $deviceToken);
            }
            // Close the connection to the server
            fclose($fp);
            \Log::info('----------------------SUCCESS---------------------------');

            return true;
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function buildMessage($title, $message, $data = [], $badge = 1)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 40);
        $optionBuilder->setPriority('high');

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
            ->setSound('sound')
            ->setBadge($badge);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        $optionBuilder->setContentAvailable(1);
        //$optionBuilder->setDelayWhileIdle(true);
        //$optionBuilder->setMutableContent(1);
        $option = $optionBuilder->build();

        $notification = $notificationBuilder->build();
        $data         = $dataBuilder->build();

        return [
            'notification' => $notification,
            'options'      => $option,
            'data'         => $data,
        ];
    }

    public function sendToDevice($token, $title, $message, $data = [], $badge = 1)
    {
        $build              = $this->buildMessage($title, $message, $data, $badge);
        $downstreamResponse = \FCM::sendTo($token, $build['options'], $build['notification'], $build['data']);
        $numberSuccess      = $downstreamResponse->numberSuccess();
        $numberFailure      = $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        \Log::debug("numberSuccess : $numberSuccess");
        \Log::debug("numberFailure : $numberFailure");

        return [
            'notification' => $build['notification']->toArray(),
            'options'      => $build['options']->toArray(),
            'data'         => $build['data']->toArray(),
        ];
    }

    public function sendToTopic($topic, $title, $message, $data = [], $badge = 1)
    {
        $build = $this->buildMessage($title, $message, $data, $badge);

        $topic = new Topics();
        $topic->topic($topic);

        $topicResponse = FCM::sendToTopic($topic, $build['options'], $build['notification'], $build['data']);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();

        return true;
    }

    public function sendToGroup($groupToken, $title, $message, $data = [], $badge = 1)
    {
        $build         = $this->buildMessage($title, $message, $data, $badge);
        $groupResponse = FCM::sendToGroup($groupToken, $build['options'], $build['notification'], $build['data']);

        $numberSuccess = $groupResponse->numberSuccess();
        $numberFailure = $groupResponse->numberFailure();
        $tokenFailed   = $groupResponse->tokensFailed();
        \Log::debug("numberSuccess : $numberSuccess");
        \Log::debug("numberFailure : $numberFailure");

        return [
            'notification'  => $build['notification']->toArray(),
            'options'       => $build['options']->toArray(),
            'data'          => $build['data']->toArray(),
            'numberFailure' => $numberFailure
        ];
    }

    public function sendVoiceToDevice($deviceToken, $data, $type = 0)
    {
        try {
            $server     = 'ssl://gateway.sandbox.push.apple.com:2195';
            $configPem  = resource_path('configs/ios_certificate_parent.pem');
            $passphrase = '';

            if (env('APP_ENV', 'local') === 'production') {
                $server = 'ssl://gateway.push.apple.com:2195';
            }
            \Log::info("File .pem:  $configPem");
            \Log::info("Push Voip to token $deviceToken");

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $configPem);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
            // Open a connection to the APNS server

            $fp = stream_socket_client(
                $server,
                $err,
                $errstr,
                60,
                STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
                $ctx
            );

            if (!$fp) {
                throw new \Exeption("Failed to connect: $err $errstr", 500);
            }

            \Log::info('Connected to APNS');

            // Create the payload body
            $body['data'] = $data;
            $body['aps']  = array(
                'content-available' => 1,
                // 'alert' => '',
                'sound'             => 'default',
                'badge'             => 0,
            );

            // Encode the payload as JSON

            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            if (!$result) {
                \Log::info('Message not delivered');
            } else {
                \Log::info('Message successfully delivered: ' . $deviceToken);
            }

            // Close the connection to the server
            fclose($fp);
            return true;
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function sendCloudMessaseToAndroid($deviceToken = "", $title = "", $pushData = array())
    {
        $url       = 'https://fcm.googleapis.com/fcm/send ';
        $serverKey = env('FCM_SERVER_KEY');
        \Log::info('Server KEY--------------');
        \Log::debug($serverKey);
        $msg                         = array(
            'title' => $title,
            'data'  => $pushData,
            'sound' => 'default'

        );
        $fields                      = array();
        $fields['data']              = $msg;
        $fields['priority']          = 'high';
        $fields['content_available'] = true;
        $fields['time_to_live']      = 2400;
        if (is_array($deviceToken)) {
            $fields['registration_ids'] = $deviceToken;
        } else {
            $fields['to'] = $deviceToken;
        }
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverKey
        );
        $curl    = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($curl);
        if ($result === false) {
            throw new Exception('FCM Send Error: ' . curl_error($curl));
        }
        curl_close($curl);
        return $result;
    }
}
