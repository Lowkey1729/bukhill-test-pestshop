<?php

namespace Support\Enums;

enum PaymentType: string
{
    case CREDIT_CARD = 'credit_card';

    case CASH_ON_DELIVERY = 'cash_on_delivery';

    case BANK_TRANSFER = 'bank_transfer';
}
