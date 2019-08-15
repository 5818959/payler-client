<?php

namespace Payler;

interface PaymentStatus
{
    /**
     * Constant representing a created payment status.
     *
     * @var string
     */
    const CREATED = 'Created';

    /**
     * Constant representing a pre authorized 3DS payment status.
     *
     * @var string
     */
    const PREAUTHORIZED3DS = 'PreAuthorized3DS';

    /**
     * Constant representing a authorized payment status.
     *
     * @var string
     */
    const AUTHORIZED = 'Authorized';

    /**
     * Constant representing a reversed payment status.
     *
     * @var string
     */
    const REVERSED = 'Reversed';

    /**
     * Constant representing a charged payment status.
     *
     * @var string
     */
    const CHARGED = 'Charged';

    /**
     * Constant representing a refunded payment status.
     *
     * @var string
     */
    const REFUNDED = 'Refunded';

    /**
     * Constant representing a rejected payment status.
     *
     * @var string
     */
    const REJECTED = 'Rejected';

    /**
     * Constant representing a pending payment status.
     *
     * @var string
     */
    const PENDING = 'Pending';

    /**
     * Constant representing a credited payment status.
     *
     * @var string
     */
    const CREDITED = 'Credited';
}
