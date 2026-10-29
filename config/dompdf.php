<?php

return [
    'show_warnings' => false,
    'public_path' => is_dir(base_path('public')) ? base_path('public') : dirname(base_path()),
    'options' => [
        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'default_paper_size' => 'a4',
        'default_font' => 'serif',
        'is_html5_parser_enabled' => true,
        'is_remote_enabled' => true,
    ],
];
