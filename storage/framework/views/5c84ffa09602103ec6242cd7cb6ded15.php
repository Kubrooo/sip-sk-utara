<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'disabled' => false,
    'label' => null,
    'error' => null,
    'name' => '',
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
    'disabled' => false,
    'label' => null,
    'error' => null,
    'name' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="w-full">
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="block text-sm font-medium text-gray-700 mb-1">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>
    <input 
        <?php echo e($disabled ? 'disabled' : ''); ?> 
        id="<?php echo e($name); ?>"
        name="<?php echo e($name); ?>"
        <?php echo e($attributes->merge(['class' => 'w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm disabled:bg-gray-100 disabled:cursor-not-allowed'])); ?>

    >
    <?php if($error): ?>
        <p class="mt-1 text-xs text-rose-600 font-medium"><?php echo e($error); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH D:\sip-sk-utara\resources\views\components\forms\input.blade.php ENDPATH**/ ?>