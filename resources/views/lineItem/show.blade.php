<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-dark text-lg font-bold">{{ $lineItem->name }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-dark mb-4">
                <p>{{ $lineItem->description }}</p>
				<hr />
                <div class="flex justify-between">
					<div class="flex pt-2 pb-2">
						<span>Price: {{ $lineItem->unit_price }}$</span>
					</div>
					<div class="flex pt-2 pb-2 text-bold">	
						<span>Quantity: {{ $lineItem->quantity }}</span>
					</div>
				</div>	
				<hr />
            </div>

            <div class="flex justify-center">
                <div class="flex p-2">
                    <a href="{{ route('lineItem.edit', $lineItem->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
				</div>
				<div class="flex p-2">
                    <form action="{{ route('lineItem.destroy', $lineItem->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-danger-button onclick="return confirm('Are you sure you want to delete {{ $lineItem->name }} for {{ $lineItem->unit_price }}$')">Delete</x-danger-button>
                    </form>
                </div>
            </div>
			
        </div>
    </div>
</x-app-layout>