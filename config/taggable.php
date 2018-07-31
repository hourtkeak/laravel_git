<?php
/**
 * Created by PhpStorm.
 * User: Sotheara
 * Date: 02-Mar-18
 * Time: 3:51 PM
 */
return [
    'delimiters'           => ',;',
    'glue'                 => ',',
    'normalizer'           => 'mb_strtolower',
    'connection'           => null,
    'throwEmptyExceptions' => false,
    'taggedModels'         => [],
    'model'                => \Cviebrock\EloquentTaggable\Models\Tag::class,
];