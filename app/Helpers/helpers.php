<?php

namespace App\Helpers;

use App\Models\Order;
use Illuminate\Support\Str;

function encrypt_data($string)
{
    $ciphering = 'AES-128-CTR';
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = env('APP_KEY');

    $encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryption;
}

function decrypt_data($string)
{
    $ciphering = 'AES-128-CTR';
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = env('APP_KEY');

    $encryption = openssl_decrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryption;
}

function generateTicket(Order $order)
{
    $ticket_uuid = Str::random();
    $ticket_data = [
        'order_uuid' => $order->uuid,
        'ticket_uuid' => $ticket_uuid,
        'user_id' => $order->user_id,
        'partner_id' => $order->partner_id,
    ];
    $order->tickets()->create([
        'uuid' => strtoupper($ticket_uuid),
        'encrypted' => encrypt_data(json_encode($ticket_data)),
    ]);
}

function generateQrCode($string)
{
    return (new \chillerlan\QRCode\QRCode())->render($string);
}
