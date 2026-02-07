<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl p-8 border border-gray-100">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-indigo-900">Find Your Next Adventure</h2>
                    <p class="text-gray-500 mt-2">Search for bus routes across Morocco</p>
                </div>

                <form action="{{ route('trips.search') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="departure_ville" :value="__('From')" class="text-indigo-900 font-semibold" />
                            <select id="departure_ville" name="departure_ville" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm py-2.5">
                                @foreach($villes as $ville)
                                    @if($ville)
                                    <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="arrival_ville" :value="__('To')" class="text-indigo-900 font-semibold" />
                            <select id="arrival_ville" name="arrival_ville" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm py-2.5">
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="travel_date" :value="__('Date')" class="text-indigo-900 font-semibold" />
                            <x-text-input id="travel_date" name="travel_date" type="date" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" :value="old('travel_date', date('Y-m-d'))" required />
                        </div>
                    </div>

                    <div class="pt-4">
                        <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 transition duration-300 shadow-lg rounded-xl text-lg">
                            {{ __('Search Trips') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>