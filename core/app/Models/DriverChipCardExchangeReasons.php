<?php

namespace App\Models\Driver;

class DriverChipCardExchangeReasons
{
    const CARD_LOST = 'lost';
    const CARD_STOLED = 'stolen';
    const CARD_INVALID = 'invalid';
    const CARD_DATA_CHANGED = 'data_changed';
    const CARD_EXPIRING = 'expiring';
}
