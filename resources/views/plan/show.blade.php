@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('plans.store') }}" class="form" enctype="multipart/form-data" id="payment-form">
            <h2 class="text-light">Netflix {{ $plan->name }}</h2>
            @csrf
            <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">

            <div class="row mb-3">
                <div class="form-group">
                    <label for="card-holder-name">Name</label>
                    <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                        placeholder="Name on the card">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <label for="card-element">Card details</label>
                    <div id="card-element"></div>
                </div>


            </div>
            <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">PAY
                {{ $plan->price }}</button>
        </form>
    </div>
@endsection
@push('footer-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="module">
        
        var stripe = Stripe('{{ env('STRIPE_KEY') }}')
        
        var elements = stripe.elements();
        var cardElement = elements.create('card', {
            style: {
                base: {
                iconColor: '#c4f0ff',
                color: '#fff',
                fontWeight: '400',
                fontFamily: 'Poppins, sans-serif',
                fontSize: '14px',
                fontSmoothing: 'antialiased',
                ':-webkit-autofill': {
                    color: '#fce883',
                },
                '::placeholder': {
                    color: '#ffffff',
                },
                },
                invalid: {
                iconColor: '#FF0060',
                color: '#FF0060',
                },
            },
            
            })
        cardElement.mount('#card-element')

        var form = document.getElementById('payment-form')
        var cardBtn = $('#card-button')
        var cardHolderName = $('#payment-holder-name')
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            cardBtn.prop('disabled', true)
            var {setupIntent, error} = await stripe.confirmCardSetup(cardBtn.data('secret'), {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.val()
                    }
                }
            })
            if (error){
                cardBtn.prop('disabled', false)
            }else{
                var token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                if (form) {
                    form.appendChild(token)
                    form.submit()
                }
            }
        });
        function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 4000);
}

function setLoading(isLoading) {
    if (isLoading) {
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}

    </script>
@endpush
