@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data" id="payment-form">
            <h2 class="text-light">Netflix {{ $plan->name }}</h2>
            @csrf
            <div class="row mb-3">
                <label for="card-holder-name">{{ __('Name') }}</label>
                <input id="card-holder-name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name"> {{--  value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" --}}

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="card-element">{{ __('Card details') }}</label>
                <div id="card-element"></div>
                {{-- <input id="card-element" type="text" class="form-control @error('card-element') is-invalid @enderror"
                    name="card_element" value="{{ old('card_element') }}" required autocomplete="name" autofocus
                    placeholder="Card details"> --}}

                @error('card-detail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-0">
                <button type="submit" class="btn btn-primary" id="payment-btn" data-secret="{{ $intent->client_secret }}">
                    {{ __('Purchase') }}
                </button>
            </div>
        </form>
    </div>
@endsection
@push('footer-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="module">
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const elements = stripe.elements();
        const caredElement = elements.create('card')

        caredElement.mount('#card-element')

        const form = $('#payment-form')
        const cardBtn = $('#payment-btn')
        const cardHolderName = $('#payment-holder-name')

        $(form).submit(async (e) { 
            e.preventDefault();
            cardBtn.disabled = true
            const {setupIntent, error} = await stripe.confirmCardSetup(cardBtn.dataset.secret, {
                payment_method: {
                    card: caredElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            })
            if (error){
                cardBtn.disable = false
            }else{
                var token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit()

            }
        });
    </script>
@endpush
