<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-between w-full sm:max-w-xl">
            <h1 class="text-dark text-lg font-bold">All Invoices</h1>
            <div>
                <a href="{{ route('invoice.create') }}" class="bg-white rounded-lg p-2">Create New</a>
            </div>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @forelse ($invoices as $invoice)
                <div class="text-dark flex justify-between py-4">
                    <a href="{{ route('invoice.show', $invoice->id) }}" class="underline">{{ $invoice->invoice_number }}</a>
                    <p>{{ $invoice->customer_name }}</p>
					<p>{{ $invoice->customer_email }}</p>
                </div>
            @empty
                <p class="text-white">You don't have any invoice yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>