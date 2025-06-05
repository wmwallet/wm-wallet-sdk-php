<?php

namespace Wmwallet\SDK\Withdraw;

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
    public string $gas_fee;
    public string $order_id;
    public int $status;
    public string $status_desc;

    public function __construct($sourceId, $chainId, $coinId, $address, $tag, $hash, $fiatAmount, $symbol, $exchangeRate, $amount, $gasFee, $orderId, $status, $statusDesc)
    {
        $this->source_id = $sourceId;
        $this->chain_id = $chainId;
        $this->coin_id = $coinId;
        $this->address = $address;
        $this->tag = $tag;
        $this->hash = $hash;
        $this->fiat_amount = $fiatAmount;
        $this->symbol = $symbol;
        $this->exchange_rate = $exchangeRate;
        $this->amount = $amount;
        $this->gas_fee = $gasFee;
        $this->order_id = $orderId;
        $this->status = $status;
        $this->status_desc = $statusDesc;
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
            $arr['gas_fee'],
            $arr['order_id'],
            $arr['status'],
            $arr['status_desc']
        );
    }
}
