<?php
namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public function __invoke(...$params){
        return static::format(...$params);
    }
    public static function format($amount, $currency = null)
    {
        $locale = config('app.locale', 'en_US'); // تعيين اللغة الافتراضية إذا لم تكن محددة في الإعدادات
        $currency = $currency ?? 'USD'; // تعيين العملة الافتراضية

        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($amount, $currency);
    }
}