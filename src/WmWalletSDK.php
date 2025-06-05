<?php

namespace Wmwallet\SDK;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;
use Wmwallet\SDK\Encrypt\Encrypt;

class WmWalletSDK
{
    private Client $client;
    private Encrypt $encrypt;
    private string $customer;

    public function __construct(Client $client, Encrypt $encrypt = null, string $customer = '')
    {
        $this->client = $client;
        $this->encrypt = $encrypt;
        $this->customer = $customer;
    }

    /**
     * @throws Exception
     */
    public static function init(array $config = []): WmWalletSDK
    {
        $config = array_merge([
            'customer' => '',
            'caCertPath' => '',
            'certPath' => '',
            'keyPath' => '',
            'secretPath' => '',
        ], $config);
        if (empty($config['customer'])) {
            throw new Exception('Config miss customer');
        }
        if (empty($config['caCertPath'])) {
            throw new Exception('Config miss caCertPath');
        }
        if (empty($config['certPath'])) {
            throw new Exception('Config miss certPath');
        }
        if (empty($config['keyPath'])) {
            throw new Exception('Config miss keyPath');
        }
        if (empty($config['secretPath'])) {
            throw new Exception('Config miss secretPath');
        }
        $secret = Encrypt::toRsaPriKey($config['secretPath']);
        $guzzleConfig = [
            RequestOptions::VERIFY => $config['caCertPath'],
            RequestOptions::CERT => $config['certPath'],
            RequestOptions::SSL_KEY => $config['keyPath'],
        ];
        $client = new Client($guzzleConfig);
        return new self($client, new Encrypt($secret), $config['customer']);
    }

    /**
     * @throws Exception|GuzzleException
     */
    public function post($request)
    {
        return $this->postWithEncrypt($request);
    }

    /**
     * @throws Exception|GuzzleException
     */
    private function postWithEncrypt($request)
    {
        $client = $this->client;
        $encrypt = $this->encrypt;
        $body = (string)$request->getBody();
        $secret = $this->generateRandomString('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 16);
        $cipher = $encrypt->aesEncryptECB($secret, $body);
        $cipherS = $encrypt->encrypt($secret);
        $request = $request
            ->withHeader('w-secret', $cipherS)
            ->withHeader('w-nonce', $this->generateRandomString('0123456789', 6))
            ->withHeader('w-ts', (string)(time() * 1000))
            ->withHeader('w-broker', $this->customer);
        $request = $this->sign($request, $body);
        $request = $request->withBody(Utils::streamFor($cipher))
            ->withHeader('Content-Length', (string)strlen($cipher))
            ->withHeader('Content-Type', 'application/json');
        $response = $client->send($request);
        $responseBody = (string)$response->getBody();
        $gwResp = json_decode($responseBody, true);
        if ($gwResp['code'] !== 0) {
            throw new Exception($gwResp['msg']);
        }
        return $gwResp['data'];
    }

    private function generateRandomString($tpl, $length): string
    {
        $result = '';
        $tplLength = strlen($tpl);
        for ($i = 0; $i < $length; $i++) {
            $result .= $tpl[rand(0, $tplLength - 1)];
        }
        return $result;
    }

    private function sign($request, $body)
    {
        $broker = $request->getHeaderLine('w-broker');
        $ts = $request->getHeaderLine('w-ts');
        $nonce = $request->getHeaderLine('w-nonce');
        $tmp = $body . $broker . $ts . $nonce;
        $hash = hash('sha256', $tmp, true);
        $ns = bin2hex($hash);
        $sb = substr($ns, 16, 32);
        return $request->withHeader('w-sign', $sb);
    }
}
