<?php

class PagesTest extends \PHPUnit_Framework_TestCase
{
    public function testHomePage()
    {
        $response_code = $this->crawl('https://gulchuk.local');

        $this->assertEquals(200, $response_code);
    }

    public function testCvPage()
    {
        $response_code = $this->crawl('https://gulchuk.local/cv');

        $this->assertEquals(200, $response_code);
    }

    private function crawl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);

        return curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }
}