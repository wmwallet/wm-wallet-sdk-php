<?php

namespace Wmwallet\SDK\Withdraw;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Wmwallet\SDK\WmWalletSDK;

class Withdraw
{

    private WmWalletSDK $client;
    private string $url;

    const ROUTE_BROKER_WITHDRAW_ORDER_CREATE = "/v1/api/broker/order/withdraw";
    const ROUTE_BROKER_WITHDRAW_ORDER_DETAIL = "/v1/api/broker/order/withdraw-detail";

    public function __construct(WmWalletSDK $client, $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * @throws Exception
     */
    public function create($req)
    {
        $request = $this->buildRequest($req, self::ROUTE_BROKER_WITHDRAW_ORDER_CREATE);
        try {
            $body = $this->client->post($request);
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
        $tmp = json_decode($body, true);
        if (!$tmp) {
            throw new Exception("Failed to decode response");
        }
        if ($tmp['code'] !== 0) {
            throw new Exception($tmp['msg']);
        }
        return $tmp['data'];
    }

    /**
     * @throws Exception
     */
    public function detail($req)
    {
        $request = $this->buildRequest($req, self::ROUTE_BROKER_WITHDRAW_ORDER_DETAIL);
        try {
            $body = $this->client->post($request);
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
        $tmp = json_decode($body, true);
        if (!$tmp) {
            throw new Exception("Failed to decode response");
        }
        if ($tmp['code'] !== 0) {
            throw new Exception($tmp['msg']);
        }
        return $tmp['data'];
    }

    /**
     * @throws Exception
     */
    private function buildRequest($req, $route): Request
    {
        $body = json_encode($req);
        if ($body === false) {
            throw new Exception("Failed to encode request body");
        }
        $headers = ['Content-Type' => 'application/json'];
        return new Request('POST', $this->url . $route, $headers, $body);
    }
}