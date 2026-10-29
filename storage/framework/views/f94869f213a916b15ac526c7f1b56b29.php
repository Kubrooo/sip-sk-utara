<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'subtitle' => null,
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
    'title' => null,
    'subtitle' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-100 p-6'])); ?>>
    <?php if($title || isset($header)): ?>
        <div class="mb-4 pb-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <?php if($title): ?>
                    <h3 class="text-lg font-semibold text-gray-900"><?php echo e($title); ?></h3>
                <?php endif; ?>
                <?php if($subtitle): ?>
                    <p class="text-sm text-gray-500 mt-0.5"><?php echo e($subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php if(isset($action)): ?>
                <div><?php echo e($action); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div>
        <?php echo e($slot); ?>

    </div>

    <?php if(isset($footer)): ?>
        <div class="mt-6 pt-4 border-t border-gray-100 bg-gray-50/50 -mx-6 -mb-6 p-4 rounded-b-xl">
            <?php echo e($footer); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\sip-sk-utara\resources\views\components\ui\card.blade.php ENDPATH**/ ?>