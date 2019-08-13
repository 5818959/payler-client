<?php

namespace Payler\Apis;

interface Merchant extends CustomerCommon, CustomerMerchant
{
    /**
     * One step payment.
     */
    public function pay();

    /**
     * Block funds for two step payment.
     */
    public function block();

    /**
     * Charge funds in two step payment.
     */
    public function charge();

    /**
     * Retrieve block funds in two step payment.
     */
    public function retrieve();

    /**
     * Return funds.
     */
    public function refund();

    /**
     * Repeat recurrent payment.
     */
    public function repeatPay();

    /**
     * Get recurrent template information.
     */
    public function getTemplate();

    /**
     * Activate/deactivate recurrent template.
     */
    public function activateTemplate();

    /**
     * Get payment status.
     */
    public function getStatus();

    /**
     * Get extended payment status.
     */
    public function getAdvancedStatus();
}
