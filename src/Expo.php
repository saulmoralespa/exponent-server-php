<?php


namespace Saulmoralespa\Exponent;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Utils;


class Expo
{
    const API_URL = 'https://exp.host/--/api/v2/push/send';

    /**
     * @param array $params
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function notify(array $params)
    {
        try{
            $client = new GuzzleClient();
            $response = $client->request('POST', self::API_URL, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => $params
            ]);
            $body= self::responseJson($response);
            return self::checkStatus($body);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public static function responseJson($response)
    {
        return Utils::jsonDecode(
            $response->getBody()->getContents()
        );
    }

    public static function checkStatus($body)
    {
        if($body->data->status === 'error')
            throw new \Exception($body->data->message);
        return $body;
    }
}