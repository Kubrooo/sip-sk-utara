<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'status' => 'default',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'status' => 'default',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $classes = match(strtolower($status)) {
        'draft_kelurahan', 'draft' => 'bg-gray-100 text-gray-800 border-gray-300',
        'review_kecamatan' => 'bg-amber-100 text-amber-800 border-amber-300',
        'review_hukum' => 'bg-blue-100 text-blue-800 border-blue-300',
        'ready_for_approval' => 'bg-purple-100 text-purple-800 border-purple-300',
        'approved', 'success' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        'rejected', 'danger' => 'bg-rose-100 text-rose-800 border-rose-300',
        default => 'bg-gray-100 text-gray-700 border-gray-200',
    };
?>

<span <?php echo e($attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border ' . $classes])); ?>>
    <?php echo e($slot->isEmpty() ? str_replace('_', ' ', strtoupper($status)) : $slot); ?>

</span>
<?php /**PATH D:\sip-sk-utara\resources\views\components\ui\badge.blade.php ENDPATH**/ ?>