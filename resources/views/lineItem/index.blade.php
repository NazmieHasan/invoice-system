<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-between w-full sm:max-w-xl">
            <h1 class="text-dark text-lg font-bold">All Line Items</h1>
            <div>
                <a href="{{ route('lineItem.create') }}" class="bg-white rounded-lg p-2">Create New</a>
            </div>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @forelse ($lineItems as $lineItem)
                <div class="text-dark flex justify-between py-4">
                    <a href="{{ route('lineItem.show', $lineItem->id) }}" class="underline">{{ $lineItem->name }}</a>
                    <p>{{ $lineItem->unit_price }}$</p>
                </div>
            @empty
                <p class="text-white">You don't have any line item yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>