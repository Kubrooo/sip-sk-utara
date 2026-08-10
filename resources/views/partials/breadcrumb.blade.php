@props([
    'items' => []
])

<nav class="flex text-xs text-gray-500 mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="hover:text-gray-900 font-medium">Dashboard</a>
        </li>
        @foreach($items as $label => $url)
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    @if($loop->last || !$url)
                        <span class="font-semibold text-gray-700">{{ $label }}</span>
                    @else
                        <a href="{{ $url }}" class="hover:text-gray-900 font-medium">{{ $label }}</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
