@extends('layouts.main', ['title' => 'Transactions'])

@section('content')
    @php
        $subtract = \App\Models\TransactionType::SUBTRACT_TYPE_ID;
    @endphp

    <section class="container mx-auto p-4 text-white">
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="md:w-3/4 w-full bg-gray-800 p-4 rounded-lg shadow-lg flex flex-col gap-4">
                <h2 class="text-3xl font-bold text-yellow-500">Your Transactions</h2>
                <div class="overflow-x-auto">
                    <table class="w-full bg-gray-700 rounded-lg shadow-lg table">
                        <thead>
                            <tr class="bg-gray-900">
                                <th class="py-2 px-4 border-b border-gray-600">Date</th>
                                <th class="py-2 px-4 border-b border-gray-600">Amount</th>
                                <th class="py-2 px-4 border-b border-gray-600">Description</th>
                                <th class="py-2 px-4 border-b border-gray-600">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr class="text-center hover:bg-gray-600">
                                    <td class="py-2 px-4 @if (!$loop->last) border-b border-gray-600 @endif">
                                        {{ $transaction->created_at->format('Y-m-d H:i') }}
                                    </td>
                                    <td
                                        class="py-2 px-4 @if (!$loop->last) border-b border-gray-600 @endif {{ $transaction->transaction_type_id === $subtract ? 'text-red-500' : 'text-green-500' }}">
                                        {{ $transaction->amount }} coins
                                    </td>
                                    <td class="py-2 px-4 @if (!$loop->last) border-b border-gray-600 @endif">
                                        {{ \Illuminate\Support\Str::limit($transaction->description, 50, '...') }}
                                        @if (strlen($transaction->description) > 50)
                                            <i class="fa-regular fa-circle-question"
                                                title="{{ $transaction->description }}"></i>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 @if (!$loop->last) border-b border-gray-600 @endif">
                                        {{ $transaction->transaction_type_id === $subtract ? 'Subtraction' : 'Addition' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $transactions->links('components.pagination') }}
            </div>
        </div>
    </section>
@endsection
