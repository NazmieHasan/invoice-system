<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
		<h1 class="mt-6 text-dark text-lg font-bold">Create New Invoice</h1>
        <div class="w-full sm:max-w-xl mt-6 mb-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
			
				@forelse ($lineItems as $lineItem)
				<?php $j= $lineItem->quantity; ?>
                <div class="text-dark flex justify-between py-4">
					<p id="{{$lineItem->id}}" class="line_items_and_qty_class">
						<input type="checkbox" name="lineItem_id_req" class="{{$lineItem->id}}" value="{{$lineItem->id}}" />
					    {{ $lineItem->name }} ({{ $lineItem->unit_price }}$)
						<select name="qty_req" class="{{$lineItem->id}}">
							<option value="" selected="selected">Quantity</option>
                            @for ($i = 1; $i <= $j; $i++)
                                <option value="{{$i}}">
                                    {{$i}}
								</option>
							@endfor
						</select>
					</p>
                </div>
                @empty
                    <p class="text-white">You don't have any line item yet.</p>
                @endforelse
				
                <!-- Line Customer Name -->
                <div class="mt-4">
                    <x-input-label for="customer_name" :value="__('Customer Name')" />
                    <x-text-input id="customer_name" class="block mt-1 w-full" type="text" name="customer_name" autofocus />
                    <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                </div>
				
				<div class="mt-4">
                    <x-input-label for="customer_email" :value="__('Customer Email')" />
                    <x-text-input id="customer_email" class="block mt-1 w-full" type="email" name="customer_email" autofocus />
                    <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                </div>
               
			    <div class="mt-4">
                    <x-input-label for="line_items_and_qty" :value="__('Line items and qty')" />
                    <x-text-input id="line_items_and_qty" class="block mt-1 w-full" type="text" name="line_items_and_qty" autofocus />
                    <x-input-error :messages="$errors->get('line_items_and_qty')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3" onclick="checkboxBtnFunc()">
                        Create
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
	<script>
	    function checkboxBtnFunc() {
			var checkboxes = document.querySelectorAll('input:checked');
            var lineItemIdValues = [...checkboxes].map(checkbox => checkbox.value);
            console.log(lineItemIdValues);
		}
	</script>
	
</x-app-layout>
