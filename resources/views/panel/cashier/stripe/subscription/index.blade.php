<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __( 'Checkout' ) }}
        </h2>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <form id="form" method="POST" action="{{ route( 'subscription.store' ) }}">

                        @csrf

                        <div class="col-span-6 sm:col-span-4 py-2">
                            <input type="text" id="card-hold-name" name="card-hold-name" placeholder="Nome do cartão" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                        </div>

                        <div class="col-span-6 sm:col-span-4 py-2">
                            <div id="card-element"></div>
                        </div>

                        <div class="col-span-6 sm:col-span-4 py-2">
                            <button id="card-button" data-secret="{{ $intent->client_secret }}" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enviar
                            </button>
                        </div>

                    </form> <!-- form -->

                </div>  <!-- p-6 bg-white border-b border-gray-200 -->

            </div>  <!-- bg-white overflow-hidden shadow-sm sm:rounded-lg -->

        </div>  <!-- max-w-7xl mx-auto sm:px-6 lg:px-8 -->

    </div>  <!-- py-12 -->

</x-app-layout>

<script>

    const stripe = Stripe( "{{ config( 'cashier.key' ) }}" );
    const elements = stripe.elements();
    const cardElement = elements.create( 'card' );
    cardElement.mount( '#card-element' );

    // Subscription payment
    const form = document.getElementById( 'form' )
    const cardHoldName = document.getElementById( 'card-hold-name' )
    const cardButton = document.getElementById( 'card-button' )
    const clientSecret = cardButton.dataset.secret

    form.addEventListener( 'submit', async ( e ) => {
        e.preventDefault()

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHoldName.value
                    }
                }
            }
        );

        if ( error ) {

            alert( 'Ops... Algo errado!' )
            console.log( error )

            return;
        }

        let token = document.createElement( 'input' )
        token.setAttribute( 'type', 'hidden' )
        token.setAttribute( 'name', 'token' )
        token.setAttribute('value', setupIntent.payment_method)
        form.appendChild( token )

        form.submit()

    })

</script>
