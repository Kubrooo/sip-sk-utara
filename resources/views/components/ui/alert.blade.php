@props([
    'type' => 'info', // info, success, warning, danger
])

@php
    $styles = [
        'info' => 'bg-blue-50 border-blue-200 text-blue-800',
        'success' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
        'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
        'danger' => 'bg-rose-50 border-rose-200 text-rose-800',
    ][$type] ?? 'bg-blue-50 border-blue-200 text-blue-800';
@endphp

<div {{ $attributes->merge(['class' => 'p-4 rounded-xl border text-sm font-medium flex items-start gap-3 ' . $styles]) }}>
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
