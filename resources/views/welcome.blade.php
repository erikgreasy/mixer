<x-layouts.app>
    <div class="w-full flex max-w-xl mx-auto flex-col divide-y">
        @forelse($mixes as $mix)
            <div class="py-5 flex gap-x-5 items-center">
                <a href="{{ $mix->url() }}" class="w-fit block">
                    <img src="{{ $mix->cover()->getUrl() }}" alt="cover photo" class="w-20 h-20 lg:w-32 lg:h-32 rounded-lg">
                </a>

                <a href="{{ $mix->url() }}" class="flex flex-grow items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">{{ $mix->published_at->diffForHumans() }}</p>

                        <h3 class="text-2xl">
                            {{ $mix->title }}
                        </h3>

                        <p class="text-gray-600">{{ $mix->author->name }}</p>
                    </div>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center">
                There are currently no mixes.
            </div>
        @endforelse
    </div>
</x-layouts.app>
