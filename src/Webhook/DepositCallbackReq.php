<?php

namespace Wmwallet\SDK\Webhook;

class DepositCallbackReq
{
    public string $source_id;
    public string $order_id;
    public string $fiat_amount;
    public string $exchange_rate;
    public string $symbol;
    public string $amount;
    public string $service_fee;
    public int $status;

    public function __construct($source_id, $order_id, $fiat_amount, $exchange_rate, $symbol, $amount, $serviceFee, $status)
    {
        $this->source_id = $source_id;
        $this->order_id = $order_id;
        $this->fiat_amount = $fiat_amount;
        $this->exchange_rate = $exchange_rate;
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->service_fee = $serviceFee;
        $this->status = $status;
    }
}