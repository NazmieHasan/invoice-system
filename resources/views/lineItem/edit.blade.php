<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-white text-lg font-bold">Update line item</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('lineItem.update', $lineItem->id) }}">
                @csrf
                @method('patch')
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" autofocus
                        value="{{ $lineItem->name }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea placeholder="Add description" name="description" id="description"
                        value="{{ $lineItem->description }}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
				
				<div class="mt-4">
                    <x-input-label for="unit_price" :value="__('Price')" />
                    <x-text-input id="unit_price" class="block mt-1 w-full" type="string" name="unit_price" autofocus
						value="{{ $lineItem->unit_price }}" />
                    <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                </div>
				
				<div class="mt-4">
                    <x-input-label for="quantity" :value="__('Quantity')" />
                    <x-text-input id="quantity" class="block mt-1 w-full" type="string" name="quantity" autofocus 
						value="{{ $lineItem->quantity }}" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
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