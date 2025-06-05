<?php

namespace Wmwallet\SDK\Deposit;

class CreateOrderResp
{
    public string $source_id;
    public int $chain_id;
    public int $coin_id;
    public string $fiat_amount;
    public string $symbol;
    public string $order_id;
    public string $exchange_rate;
    public string $amount;
    public string $service_fee;
    public string $url;

    public function __construct($source_id, $chain_id, $coin_id, $fiat_amount, $symbol, $order_id, $exchange_rate, $amount, $service_fee, $url)
    {
        $this->source_id = $source_id;
        $this->chain_id = $chain_id;
        $this->coin_id = $coin_id;
        $this->fiat_amount = $fiat_amount;
        $this->symbol = $symbol;
        $this->order_id = $order_id;
        $this->exchange_rate = $exchange_rate;
        $this->amount = $amount;
        $this->service_fee = $service_fee;
        $this->url = $url;
    }

    public static function fromArray(array $arr): CreateOrderResp
    {
        return new self(
            $arr['source_id'],
            $arr['chain_id'],
            $arr['coin_id'],
            $arr['fiat_amount'],
            $arr['symbol'],
            $arr['order_id'],
            $arr['exchange_rate'],
            $arr['amount'],
            $arr['service_fee'],
            $arr['url']
        );
    }
}