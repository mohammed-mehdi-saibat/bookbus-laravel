<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Travel Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($reservations->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-12 text-center border border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No active bookings</h3>
                    <p class="text-gray-500 mt-1 text-sm">Your booked tickets will appear here.</p>
                    <a href="{{ route('trips.index') }}" class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Find a Trip
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($reservations as $reservation)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <span class="text-xs font-black text-indigo-500 uppercase tracking-widest">Confirmation Number</span>
                                        <p class="text-lg font-mono font-bold text-gray-800">#BK-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="px-3 py-1 {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs font-bold rounded-full uppercase">
                                            {{ $reservation->status }}
                                        </span>
                                        
                                        @if($reservation->status === 'confirmed')
                                            <form action="{{ route('bookings.cancel', $reservation) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 underline transition">
                                                    Cancel Trip
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between bg-indigo-50/50 rounded-xl p-4 mb-6">
                                    <div class="text-left">
                                        <p class="text-xs text-indigo-400 uppercase font-semibold">Origin</p>
                                        <p class="font-bold text-indigo-900">{{ $reservation->segment->departureEtape->gare->ville->name }}</p>
                                        <p class="text-xs text-indigo-700/70">{{ $reservation->segment->departureEtape->gare->name }}</p>
                                    </div>
                                    
                                    <div class="flex-1 flex flex-col items-center px-4">
                                        <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-xs text-indigo-400 uppercase font-semibold">Destination</p>
                                        <p class="font-bold text-indigo-900">{{ $reservation->segment->arrivalEtape->gare->ville->name }}</p>
                                        <p class="text-xs text-indigo-700/70">{{ $reservation->segment->arrivalEtape->gare->name }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-tighter text-gray-400">Date</p>
                                            <p class="font-semibold text-gray-700">{{ $reservation->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase tracking-tighter text-gray-400">Seats</p>
                                            <p class="font-semibold text-gray-700">{{ $reservation->seats_reserved }} Passenger(s)</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] uppercase tracking-tighter text-gray-400">Total Paid</p>
                                        <p class="text-xl font-black text-indigo-600">{{ number_format($reservation->total_price, 2) }} DH</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>