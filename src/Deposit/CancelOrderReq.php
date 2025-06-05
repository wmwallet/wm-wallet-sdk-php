<?php
namespace Wmwallet\SDK\Deposit;

class CancelOrderReq
{
    public string $source_id;

    public function __construct($sourceId)
    {
        $this->source_id = $sourceId;
    }
}