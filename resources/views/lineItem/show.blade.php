<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-dark text-lg font-bold">{{ $lineItem->name }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-dark mb-4">
                <p>{{ $lineItem->description }}</p>
				<hr />
                <p>Price {{ $lineItem->unit_price }}$</p>
				<p>Quantity: {{ $lineItem->quantity }}</p>
				<hr />
            </div>

            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{ route('lineItem.edit', $lineItem->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
                    <form action="{{ route('lineItem.destroy', $lineItem->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-danger-button style="margin-left: 10px;">Delete</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>