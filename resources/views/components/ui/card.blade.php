@props([
    'title' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-100 p-6']) }}>
    @if ($title || isset($header))
        <div class="mb-4 pb-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                @if ($title)
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="text-sm text-gray-500 mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if (isset($action))
                <div>{{ $action }}</div>
            @endif
        </div>
    @endif

    <div>
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="mt-6 pt-4 border-t border-gray-100 bg-gray-50/50 -mx-6 -mb-6 p-4 rounded-b-xl">
            {{ $footer }}
        </div>
    @endif
</div>
