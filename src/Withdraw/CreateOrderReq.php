<?php

namespace Wmwallet\SDK\Withdraw;

class CreateOrderReq
{
    public string $source_id;
    public int $chain_id;
    public int $coin_id;
    public string $address;
    public string $tag;
    public string $amount;
    public string $callback_url;

    public function __construct($sourceId, $chainId, $coinId, $address, $tag, $amount, $callbackUrl)
    {
        $this->source_id = $sourceId;
        $this->chain_id = $chainId;
        $this->coin_id = $coinId;
        $this->address = $address;
        $this->tag = $tag;
        $this->amount = $amount;
        $this->callback_url = $callbackUrl;
    }
}