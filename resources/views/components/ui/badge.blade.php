@props([
    'status' => 'default',
])

@php
    $classes = match(strtolower($status)) {
        'draft_kelurahan', 'draft' => 'bg-gray-100 text-gray-800 border-gray-300',
        'review_kecamatan' => 'bg-amber-100 text-amber-800 border-amber-300',
        'review_hukum' => 'bg-blue-100 text-blue-800 border-blue-300',
        'ready_for_approval' => 'bg-purple-100 text-purple-800 border-purple-300',
        'approved', 'success' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        'rejected', 'danger' => 'bg-rose-100 text-rose-800 border-rose-300',
        default => 'bg-gray-100 text-gray-700 border-gray-200',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border ' . $classes]) }}>
    {{ $slot->isEmpty() ? str_replace('_', ' ', strtoupper($status)) : $slot }}
</span>
