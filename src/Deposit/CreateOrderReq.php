<?php

namespace Wmwallet\SDK\Deposit;

class CreateOrderReq
{
    public string $source_id;
    public int $chain_id;
    public int $coin_id;
    public string $fiat_amount;
    public string $symbol;
    public string $callback_url;
    public string $exchangeRate;
    public string $amount;

    public function __construct($sourceId, $chainId, $coinId, $fiatAmount, $symbol, $callbackUrl, $exchangeRate = "", $amount = "")
    {
        $this->source_id = $sourceId;
        $this->chain_id = $chainId;
        $this->coin_id = $coinId;
        $this->fiat_amount = $fiatAmount;
        $this->symbol = $symbol;
        $this->callback_url = $callbackUrl;
        $this->exchangeRate = $exchangeRate;
        $this->amount = $amount;
    }
}