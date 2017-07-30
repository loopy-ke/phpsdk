<?php

use Loopy\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new Client("123456", "1234567891011121314");
    }

    public function testSigner()
    {
        $url = "http://example.com/";
        $token = sha1($this->client->getKey() . $url . $this->client->getSecret());
        $signedPdfUrl = $this->client->getEndPoint() . $this->client->getKey() . '/' . $token . '/pdf?url=' . urlencode($url);
        $this->assertEquals($token, $this->client->signUrl($url), "The client cannot sign urls");
        $this->assertEquals($signedPdfUrl, $this->client->getPdfUrl($url), "The client cannot sign urls");
    }
}