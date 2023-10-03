<x-mail::message>
# Subscription Created

Your subscription has been created. Please find the details of your new subscription below:

| Subscription details | Quantity | Price |
| :---------- | :---------: | :---------: |
| **{{ $plan->name }}**<br>{{ $plan->description }} | 1 | £{{ number_format($plan->price, 2) }} |
@foreach(json_decode($subscription->addOns) as $addon)
| {{ $addon->name }} | {{ $addon->quantity }} | £{{ number_format($addon->amount, 2) }} |
@endforeach
<br>
Total Subscription Value:
**£{{ number_format($plan->price + array_sum(array_column(json_decode($subscription->addOns, true),'amount')), 2) }}**
<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
