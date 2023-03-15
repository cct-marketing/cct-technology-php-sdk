<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
             __DIR__ . '/src',
             __DIR__ . '/tests',
         ])
    ->exclude(
        [
            'Infrastructure/Serialization/Mapper',
        ]
    );

return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setLineEnding("\n")
    ->setRules(
        [
            '@PSR12' => true,
            '@Symfony' => true,

            // General config
            'full_opening_tag' => false,
            'ternary_to_null_coalescing' => true,
            'yoda_style' => false,
            'increment_style' => false,
            'concat_space' => [
                'spacing' => 'one',
            ],

            'class_definition' => [
                'single_line' => false,
            ],

            // PHP DOC
            'general_phpdoc_tag_rename' => false,
            'phpdoc_inline_tag_normalizer' => false,
            'phpdoc_tag_type' => false,
            'phpdoc_annotation_without_dot' => false,
            'phpdoc_no_empty_return' => false,
            'phpdoc_summary' => false,
            'phpdoc_types_order' => false,
            'align_multiline_comment' => [
                'comment_type' => 'phpdocs_like',
            ],
            'no_superfluous_phpdoc_tags' => true,
            'single_line_throw' => false,
            'ordered_imports' => false,
        ]
    )
    ->setFinder($finder);
