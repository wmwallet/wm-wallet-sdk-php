<?php

namespace Wmwallet\SDK\Webhook;

class WithdrawCallbackResp
{
    public int $code;
    public string $msg;

    public function __construct(int $code, string $msg)
    {
        $this->code = $code;
        $this->msg = $msg;
    }
}
