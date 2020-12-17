<?php

use Saulmoralespa\Exponent\Expo;
use PHPUnit\Framework\TestCase;

class ExponentTest extends TestCase
{
    public function testNotify()
    {
        $expo = new Expo();

        $params = [
          'to' => 'ExponentPushToken[unique]',
          'title' => 'greet',
          'body'=> 'hello',
          'data' => '{"url":"https://www.json.org"}'
        ];

        $res = $expo->notify($params);
    }
}