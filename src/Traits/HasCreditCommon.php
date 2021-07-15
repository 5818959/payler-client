<?php

namespace Payler\Traits;

trait HasCreditCommon
{
    /**
     * Get balances.
     */
    public function getBalance()
    {
        return $this->request('v1/GetBalance', [
            'password' => $this->password,
        ]);
    }
}
