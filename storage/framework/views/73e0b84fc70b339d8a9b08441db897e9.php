<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'info', // info, success, warning, danger
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
    'type' => 'info', // info, success, warning, danger
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $styles = [
        'info' => 'bg-blue-50 border-blue-200 text-blue-800',
        'success' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
        'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
        'danger' => 'bg-rose-50 border-rose-200 text-rose-800',
    ][$type] ?? 'bg-blue-50 border-blue-200 text-blue-800';
?>

<div <?php echo e($attributes->merge(['class' => 'p-4 rounded-xl border text-sm font-medium flex items-start gap-3 ' . $styles])); ?>>
    <div class="flex-1">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH D:\sip-sk-utara\resources\views\components\ui\alert.blade.php ENDPATH**/ ?>