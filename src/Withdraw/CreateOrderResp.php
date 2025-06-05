<?php

namespace Wmwallet\SDK\Withdraw;

class CreateOrderResp
{
    public string $source_id;
    public string $order_id;

    public function __construct($sourceId,  $orderId)
    {
        $this->source_id = $sourceId;
        $this->order_id = $orderId;
    }

    public static function fromArray(array $arr): CreateOrderResp
    {
        return new self(
            $arr['source_id'],
            $arr['order_id']
        );
    }
}