<?php

namespace Payler\Traits;

trait HasCreditCommon
{
    /**
     * Get balances.
     */
    public function getBalance()
    {
        return $this->request('GetBalance', [
            'password' => $this->password,
        ]);
    }
}
