# A PHP wrapper for [Payler's](https://payler.com/docs/acquiring_docs) APIs.

## Details

Based on Payler API 1.0.2.

Currently implemented methods:

1. Gate API (gapi) - nothing
2. Credit Gate API (cgapi) - nothing
3. Merchant API (mapi)
    * Pay
    * Block
    * Charge
    * Retrieve
    * Refund
    * RepeatPay
    * GetTemplate
    * ActivateTemplate
    * GetStatus
    * GetAdvancedStatus
    * Send3DS
4. Credit Merchant API (cmapi)
    Credit
    GetBalance
5. Customer (all APIs)
    * GetStatusSaveCard
    * GetCardList
    * RemoveCard
    * SaveCard
    * CustomerRegister
    * CustomerUpdate
    * CustomerDelete
    * CustomerGetStatus

## Examples

You can find some usage examples in the `examples/` folder.
