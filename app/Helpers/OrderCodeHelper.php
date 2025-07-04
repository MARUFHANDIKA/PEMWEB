<?php

namespace App\Helpers;

class OrderCodeHelper
{
    /**
     * Generate a unique order code like ORD-20250704-00023
     */
    public static function generate($orderId)
    {
        $date = now()->format('Ymd'); // Format: 20250704
        $code = 'ORD-' . $date . '-' . str_pad($orderId, 5, '0', STR_PAD_LEFT);
        return $code;
    }
}
