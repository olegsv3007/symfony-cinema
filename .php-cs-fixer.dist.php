<?php

$finder = PhpCsFixer\Finder
    ::create()
    ->in(
        sprintf('%s/src', __DIR__),
        sprintf('%s/tests', __DIR__),
    );

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@PhpCsFixer' => true,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/array_notation/array_syntax.rst
        'array_syntax' => [
            'syntax' => 'short',
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_align.rst
        'phpdoc_align' => [
            'align' => 'left',
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/control_structure/yoda_style.rst
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/control_structure/no_superfluous_elseif.rst
        'no_superfluous_elseif' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/php_unit/php_unit_internal_class.rst
        'php_unit_internal_class' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/php_unit/php_unit_test_class_requires_covers.rst
        'php_unit_test_class_requires_covers' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/basic/braces.rst
        'braces' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/operator/concat_space.rst
        'concat_space' => [
            'spacing' => 'one',
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/semicolon/multiline_whitespace_before_semicolons.rst
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/whitespace/method_chaining_indentation.rst
        'method_chaining_indentation' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/operator/no_space_around_double_colon.rst
        'no_space_around_double_colon' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_summary.rst
        'phpdoc_summary' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_no_alias_tag.rst
        'phpdoc_no_alias_tag' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/class_notation/ordered_class_elements.rst
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'phpunit',
                'method_public_abstract_static',
                'method_protected_abstract_static',
                'method_public_abstract',
                'method_protected_abstract',
                'method_public_static',
                'method_protected_static',
                'method_public',
                'method_protected',
                'method_private',
                'method_private_static',
            ],
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_types_order.rst
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
        ],
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/function_notation/single_line_throw.rst
        'single_line_throw' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/operator/increment_style.rst
        'increment_style' => false,
        // @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/operator/standardize_increment.rst
        'standardize_increment' => false,
    ])
    ->setFinder($finder);
