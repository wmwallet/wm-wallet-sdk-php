<?php

namespace Wmwallet\SDK\Deposit;
class GetDetailResp
{
    public string $source_id;
    public int $chain_id;
    public int $coin_id;
    public string $address;
    public string $tag;
    public string $hash;
    public string $fiat_amount;
    public string $symbol;
    public string $exchange_rate;
    public string $amount;
    public string $service_fee;
    public string $order_id;
    public string $url;
    public int $status;
    public string $status_desc;

    public function __construct($sourceId, $chainId, $coinId, $address, $tag, $hash, $fiat_amount, $symbol, $exchange_rate, $amount, $service_fee, $order_id, $url, $status, $status_desc)
    {
        $this->source_id = $sourceId;
        $this->chain_id = $chainId;
        $this->coin_id = $coinId;
        $this->address = $address;
        $this->tag = $tag;
        $this->hash = $hash;
        $this->fiat_amount = $fiat_amount;
        $this->symbol = $symbol;
        $this->exchange_rate = $exchange_rate;
        $this->amount = $amount;
        $this->service_fee = $service_fee;
        $this->order_id = $order_id;
        $this->url = $url;
        $this->status = $status;
        $this->status_desc = $status_desc;
    }

    public static function fromArray(array $arr): GetDetailResp
    {
        return new self(
            $arr['source_id'],
            $arr['chain_id'],
            $arr['coin_id'],
            $arr['address'],
            $arr['tag'],
            $arr['hash'],
            $arr['fiat_amount'],
            $arr['symbol'],
            $arr['exchange_rate'],
            $arr['amount'],
            $arr['service_fee'],
            $arr['order_id'],
            $arr['url'],
            $arr['status'],
            $arr['status_desc']
        );
    }
}
