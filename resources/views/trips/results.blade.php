<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>  
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-indigo-900">Available Trips</h2>
                    <p class="text-gray-600">Results for {{ \Carbon\Carbon::parse($request->travel_date)->format('D, d M Y') }}</p>
                </div>
                <a href="{{ route('trips.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Modify Search
                </a>
            </div>

            @if($results->isEmpty())
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-50 rounded-full mb-4">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">No trips found</h3>
                    <p class="text-gray-500 mt-2">Try selecting a different date or city combination.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($results as $segment)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <div class="text-center">
                                                <span class="block text-xl font-bold text-indigo-900">{{ \Carbon\Carbon::parse($segment->departureEtape?->passage_hour)->format('H:i') }}</span>
                                                <span class="text-xs text-gray-400 uppercase tracking-wider">Departure</span>
                                            </div>
                                            <div class="flex-1 flex items-center px-4">
                                                <div class="h-0.5 bg-indigo-100 w-full relative">
                                                    <div class="absolute -top-1.5 left-0 w-3 h-3 rounded-full bg-indigo-500"></div>
                                                    <div class="absolute -top-1.5 right-0 w-3 h-3 rounded-full border-2 border-indigo-500 bg-white"></div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <span class="block text-xl font-bold text-indigo-900">{{ \Carbon\Carbon::parse($segment->arrivalEtape?->passage_hour)->format('H:i') }}</span>
                                                <span class="text-xs text-gray-400 uppercase tracking-wider">Arrival</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-between text-sm">
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $segment->departureEtape?->gare?->name }}</p>
                                                <p class="text-gray-500">{{ $segment->departureEtape?->gare?->ville?->name }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900">{{ $segment->arrivalEtape?->gare?->name }}</p>
                                                <p class="text-gray-500">{{ $segment->arrivalEtape?->gare?->ville?->name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="md:w-px md:h-20 bg-gray-100"></div>

                                    <div class="flex items-center justify-between md:flex-col md:items-end md:w-48">
                                        <div class="text-left md:text-right">
                                            <span class="block text-2xl font-black text-indigo-600">{{ $segment->tariff }} <small class="text-sm font-normal">DH</small></span>
                                            <span class="text-xs {{ $segment->seats_available > 0 ? 'text-green-600' : 'text-red-600' }} font-bold">
                                                {{ $segment->seats_available > 0 ? $segment->seats_available . ' seats left' : 'Sold Out' }}
                                            </span>
                                        </div>
                                        
                                        <form action="{{ route('bookings.store') }}" method="POST" class="mt-4 w-full">
                                            @csrf
                                            <input type="hidden" name="segment_id" value="{{ $segment->id }}">
                                            <div class="flex items-center mb-2">
                                                <label class="text-xs font-bold text-gray-400 uppercase mr-2">Seats</label>
                                                <input type="number" name="seats_reserved" value="1" min="1" max="{{ min(10, $segment->seats_available) }}" class="w-full rounded-lg border-gray-200 text-sm" {{ $segment->seats_available <= 0 ? 'disabled' : '' }}>
                                            </div>
                                            <button type="submit" 
                                                class="w-full px-6 py-2 {{ $segment->seats_available > 0 ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-400 cursor-not-allowed' }} text-white font-bold rounded-xl transition duration-200"
                                                {{ $segment->seats_available <= 0 ? 'disabled' : '' }}>
                                                {{ $segment->seats_available > 0 ? 'Book Now' : 'Full' }}
                                            </button>
                                        </form>
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