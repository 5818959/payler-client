<?php

namespace Payler\Exceptions;

/**
 * Request exception.
 */
class RequestException extends PaylerException
{
    /**
     * No error.
     */
    const NONE = 0;

    /**
     * Invalid amount.
     */
    const INVALID_AMOUNT = 1;

    /**
     * Card balance exceeded.
     */
    const BALANCE_EXCEEDED = 2;

    /**
     * Duplicate order id.
     */
    const DUPLICATE_ORDER_ID = 3;

    /**
     * Issuer bank declined operation.
     */
    const ISSUER_DECLINED_OPERATION = 4;

    /**
     * Card limit exceeded.
     */
    const LIMIT_EXCEEDED = 5;

    /**
     * The operation was rejected by the security system.
     */
    const AF_DECLINED = 6;

    /**
     * Invalid order state.
     */
    const INVALID_ORDER_STATE = 7;

    /**
     * Order not found.
     */
    const ORDER_NOT_FOUND = 9;

    /**
     * Common processing error.
     */
    const PROCESSING_ERROR = 10;

    /**
     * Partial retrieve operation not allowed.
     */
    const PARTIAL_RETRIEVE_NOT_ALLOWED = 11;

    /**
     * The operation wad declined by gate.
     */
    const GATE_DECLINED = 13;

    /**
     * Invalid card information.
     */
    const INVALID_CARD_INFO = 14;

    /**
     * Invalid card number.
     */
    const INVALID_CARDNUMBER = 15;

    /**
     * Invalid card holder.
     */
    const INVALID_CARDHOLDER = 16;

    /**
     * API not allowed from this IP.
     */
    const API_NOT_ALLOWED = 18;

    /**
     * Invalid password.
     */
    const INVALID_PASSWORD = 19;

    /**
     * Invalid request parameters.
     */
    const INVALID_PARAMS = 20;

    /**
     * Session timeout.
     */
    const SESSION_TIMEOUT = 21;

    /**
     * Merchant not found.
     */
    const MERCHANT_NOT_FOUND = 22;

    /**
     * Session not found.
     */
    const SESSION_NOT_FOUND = 24;

    /**
     * Card is expired.
     */
    const CARD_EXPIRED = 25;

    /**
     * Recurrent template not found.
     */
    const RECURRENT_TEMPLATE_NOT_FOUND = 26;

    /**
     * Recurrent template not active.
     */
    const RECURRENT_TEMPLATE_NOT_ACTIVE = 27;

    /**
     * No transaction by template.
     */
    const NO_TRANSACTION_BY_TEMPLATE = 28;

    /**
     * Recurrent payments not supported.
     */
    const RECURRENT_PAYMENTS_NOT_SUPPORTED = 100;

    /**
     * Recurrent template expired.
     */
    const EXPIRED_RECURRENT_TEMPLATE = 101;

    /**
     * The recurrent payment template is registered to another terminal.
     */
    const RECURRENT_TEMPLATE_ANOTHER_TERMINAL = 102;

    /**
     * Failed to update activity status of recurrent payment template.
     */
    const FAILED_UPDATE_ACTIVE_STATUS = 103;

    /**
     * The recurrent payment template activation requires confirmation from the bank.
     */
    const TEMPLATE_ACTIVATION_REQUIRES_BANK_CONF = 104;

    /**
     * Recurrent refunds are not supported by the bank.
     */
    const REFUND_OF_RECURRENT_NOT_SUPPORTED = 105;

    /**
     * Too frequent recurrent payments.
     */
    const TOO_FREQUENT_RECURRENT_PAYMENTS = 106;

    /**
     * Partial refund not allowed.
     */
    const PARTIAL_REFUND_NOT_ALLOWED = 200;

    /**
     * Multiple refund not supported.
     */
    const MULTIPLE_REFUND_NOT_SUPPORTED = 201;

    /**
     * Partial charge not allowed.
     */
    const PARTIAL_CHARGE_NOT_ALLOWED = 202;

    /**
     * The period for changing the amount of blocked funds has expired.
     */
    const EXPIRED_RETRIEVE_PERIOD = 300;

    /**
     * Invalid card expiration month.
     */
    const INVALID_EXPIRY_MONTH = 400;

    /**
     * Invalid card expiration year.
     */
    const INVALID_EXPIRY_YEAR = 401;

    /**
     * Invalid card secure code.
     */
    const INVALID_SECURE_CODE = 402;

    /**
     * Invalid email.
     */
    const INVALID_EMAIL = 403;

    /**
     * Card is inactive.
     */
    const CARD_INACTIVE = 500;

    /**
     * The operation is not supported by the card.
     */
    const OPERATION_NOT_SUPPORTED = 501;

    /**
     * The operation is declined by card holder.
     */
    const DECLINED_BY_CARDHOLDER = 502;

    /**
     * Error processing card PIN.
     */
    const PIN_ERROR = 503;

    /**
     * Restricted card.
     */
    const RESTRICTED_CARD = 504;

    /**
     * Invalid card status.
     */
    const INVALID_CARD_STATUS = 505;

    /**
     * Duplicated operation.
     */
    const DUPLICATED_OPERATION = 600;

    /**
     * Payment request is already being processed.
     */
    const IN_PROGRESS_ERROR = 601;

    /**
     * Order was paid earlier.
     */
    const PAID_EARLIER = 602;

    /**
     * No registered transactions found for the specified order id.
     */
    const DEAL_NOT_FOUND = 603;

    /**
     * Incorrect transaction type.
     */
    const INCORRECT_TRANSACTION_TYPE = 604;

    /**
     * Unable to complete transaction in non-two-stage payment.
     */
    const TRANSACTION_NOT_TWO_STEP = 605;

    /**
     * The payment attempt with the specified identifier not found.
     */
    const ATTEMPT_NOT_FOUND = 606;

    /**
     * Attempts number exceeded.
     */
    const ATTEMPTS_NUMBER_EXCEEDED = 607;

    /**
     * There is a newer attempt found.
     */
    const THERE_IS_NEWER_ATTEMPT = 608;

    /**
     * Number of attempts to send an email exceeded.
     */
    const EMAIL_ATTEMPTS_NUMBER_EXCEEDED = 609;

    /**
     * Card not found.
     */
    const CARD_NOT_FOUND = 610;

    /**
     * Card already saved.
     */
    const CARD_ALREADY_SAVED = 611;

    /**
     * Customer not found.
     */
    const CUSTOMER_NOT_FOUND = 612;

    /**
     * Unable to create the specified response template.
     */
    const TEMPLATE_NOT_FOUND = 700;

    /**
     * No redirect URL to the merchant's website after payment.
     */
    const RETURN_URL_NOT_SET = 701;

    /**
     * Merchant's terminal not found.
     */
    const TERMINAL_NOT_FOUND = 702;

    /**
     * Currency not supported.
     */
    const CURRENCY_NOT_SUPPORTED = 703;

    /**
     * Cash desk service is not connected or not active.
     */
    const RECEIPT_SERVICE_NOT_ENABLED = 704;

    /**
     * 3DS rejected or execution is not possible due to an error.
     */
    const THREE_DS_FAIL = 800;

    /**
     * 3DS result not found.
     */
    const NO_RESULT_OF_3DS = 801;

    /**
     * 3DS preprocess information not found.
     */
    const PREPROCESS_3DS_INFO_NOT_FOUND = 802;

    /**
     * Card not support 3DS.
     */
    const NOT_INVOLVED_IN_3DS = 803;

    /**
     * The operation is not allowed to merchant.
     */
    const OPERATION_NOT_ALLOWED_TO_MERCHANT = 900;

    /**
     * The operation is not complete.
     */
    const COMPLETED_PARTIALLY = 901;

    /**
     * Reconciliation failed.
     */
    const RECONCILE_ERROR = 902;

    /**
     * Operation rejected.
     */
    const DECLINED = 903;

    /**
     * Temporary problem.
     */
    const TEMPORARY_MALFUNCTION = 904;

    /**
     * Unsupported card type.
     */
    const UNSUPPORTED_CARD_TYPE = 905;

    /**
     * For electronic wallets refund is not supported.
     */
    const EMONEY_REFUND_NOT_SUPPORTED = 1000;

    /**
     * Checkout method not allowed for merchant.
     */
    const CHECKOUT_METHOD_NOT_ALLOWED = 1100;

    /**
     * Operation not confirmed by merchant.
     */
    const OPERATION_NOT_CONFIRMED = 1101;

    /**
     * Is card balance exceeded?
     *
     * @return boolean
     */
    public function isBalanceExceeded()
    {
        return self::BALANCE_EXCEEDED === $this->code;
    }

    /**
     * Is card invalid?
     *
     * @return boolean
     */
    public function isInvalidCard()
    {
        return in_array($this->code, [
            self::INVALID_CARD_INFO,
            self::INVALID_CARDNUMBER,
            self::INVALID_CARDHOLDER,
            self::CARD_EXPIRED,
            self::INVALID_EXPIRY_MONTH,
            self::INVALID_EXPIRY_YEAR,
            self::INVALID_SECURE_CODE,
            self::CARD_INACTIVE,
            self::OPERATION_NOT_SUPPORTED,
            self::DECLINED_BY_CARDHOLDER,
            self::RESTRICTED_CARD,
            self::INVALID_CARD_STATUS,
            self::THREE_DS_FAIL,
            self::NO_RESULT_OF_3DS,
            self::PREPROCESS_3DS_INFO_NOT_FOUND,
            self::DECLINED,
            self::UNSUPPORTED_CARD_TYPE,
        ]);
    }

    /**
     * Is paid earlier?
     *
     * @return boolean
     */
    public function isPaidEarlier()
    {
        return self::PAID_EARLIER === $this->code;
    }
}
