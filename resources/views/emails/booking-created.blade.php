@component('mail::message')

Dear {{ $booking->user->name }},

Your booking for service **{{ $booking->service->name }}** on **{{ $booking->slot->start_time->format('d M Y, H:i') }}** has been received.

Status: **{{ ucfirst($booking->status) }}**

Thanks,<br>
{{ config('app.name') }}
@endcomponent
