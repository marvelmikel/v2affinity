<!DOCTYPE html>
<!-- <script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.44.2/js/client.min.js"></script> -->

<div class="container">
    <h2>Braintree Plans</h2>
    <ul>
    @foreach ($plans as $plan)
    <li>{{ $plan->id }} - {{ $plan->name }} - ${{ $plan->price }} - {{ $plan->trialDuration }} {{ $plan->trialDurationUnit }}</li>
@endforeach

    </ul>
</div>
</html>