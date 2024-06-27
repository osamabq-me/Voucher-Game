<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full mt-4 divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Username</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Product</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Amount</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Total Price</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Payment Method</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Whatsapp Number</th>
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                Ordered At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach ($histories as $history)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->user->username }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->amount }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">Rp
                                    {{ number_format($history->payment->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->payment->method }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->payment->whatsapp }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $history->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
