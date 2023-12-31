<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-dark text-lg font-bold">Update invoice witn number {{ $invoice->invoice_number }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('invoice.update', $invoice->id) }}">
                @csrf
				@method('patch')
				
				@forelse ($lineItems as $lineItem)
                <div class="text-dark flex justify-between py-4">
					<p>
					    <input type="checkbox" name="line_items[]" value="{{$lineItem->id}}" 
							@foreach ($lineItemWithCheckboxChecked as $lineItemChecked)
								@if ($lineItem->id == $lineItemChecked)
									checked
								@endif
							@endforeach
						/> 
						<label>{{$lineItem->name}} ({{$lineItem->unit_price}}$), Quantity is 1</label>
				    </p>
                </div>
                @empty
                    <p class="text-dark">You don't have any line item yet.</p>
                @endforelse
				
                <!-- Line Customer Name -->
                <div class="mt-4">
                    <x-input-label for="customer_name" :value="__('Customer Name')" />
                    <x-text-input id="customer_name" class="block mt-1 w-full" type="text" name="customer_name" autofocus 
						value="{{ $invoice->customer_name }}" />
                    <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                </div>
				
				<div class="mt-4">
                    <x-input-label for="customer_email" :value="__('Customer Email')" />
                    <x-text-input id="customer_email" class="block mt-1 w-full" type="email" name="customer_email" autofocus 
						value="{{ $invoice->customer_email }}" />
                    <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>