<?php

namespace Wmwallet\SDK\Webhook;

class WithdrawCallbackReq
{
    public string $source_id;
    public string $order_id;
    public int $chain_id;
    public int $coin_id;
    public string $tag;
    public string $amount;
    public string $gas_fee;
    public int $status;

    public function __construct($sourceId, $orderId, $chainId, $coinId, $tag, $amount, $gasFee, $status)
    {
        $this->source_id = $sourceId;
        $this->order_id = $orderId;
        $this->chain_id = $chainId;
        $this->coin_id = $coinId;
        $this->tag = $tag;
        $this->amount = $amount;
        $this->gas_fee = $gasFee;
        $this->status = $status;
    }
}