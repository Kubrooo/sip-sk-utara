@props([
    'disabled' => false,
    'label' => null,
    'error' => null,
    'name' => '',
    'rows' => 4,
])

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif
    <textarea 
        {{ $disabled ? 'disabled' : '' }} 
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm disabled:bg-gray-100 disabled:cursor-not-allowed']) }}
    >{{ $slot }}</textarea>
    @if($error)
        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $error }}</p>
    @endif
</div>
