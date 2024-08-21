<p>Dear {{ $user->name }},</p>

<p>Your payment for the Reference Date {{ $payment->auctionReference->auction_reference_date }} has been {{ $payment->status }}.</p>

@if($payment->status == 'rejected')
    <p>Reason: {{ $payment->reason }}</p>
@endif

<p>Thank you for your attention.</p>
