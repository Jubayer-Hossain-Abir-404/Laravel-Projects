<?php
namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function processPayment(int $amount);
    public function refundPayment(int $transactionId);
}