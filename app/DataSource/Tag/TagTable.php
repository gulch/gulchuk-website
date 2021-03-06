<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\DataSource\Tag;

use Atlas\Table\Table;

/**
 * @method TagRow|null fetchRow($primaryVal)
 * @method TagRow[] fetchRows(array $primaryVals)
 * @method TagTableSelect select(array $whereEquals = [])
 * @method TagRow newRow(array $cols = [])
 * @method TagRow newSelectedRow(array $cols)
 */
class TagTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'Tag';

    const COLUMNS = [
        'id' => array(
            'name' => 'id',
            'type' => 'int unsigned',
            'size' => 10,
            'scale' => 0,
            'notnull' => true,
            'default' => null,
            'autoinc' => true,
            'primary' => true,
            'options' => null,
        ),
        'slug' => array(
            'name' => 'slug',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'title' => array(
            'name' => 'title',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'content' => array(
            'name' => 'content',
            'type' => 'text',
            'size' => 65535,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'seo_title' => array(
            'name' => 'seo_title',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => 'NULL',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'seo_description' => array(
            'name' => 'seo_description',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => 'NULL',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'seo_keywords' => array(
            'name' => 'seo_keywords',
            'type' => 'varchar',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => 'NULL',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'created_at' => array(
            'name' => 'created_at',
            'type' => 'datetime',
            'size' => null,
            'scale' => null,
            'notnull' => true,
            'default' => 'current_timestamp()',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
        'updated_at' => array(
            'name' => 'updated_at',
            'type' => 'datetime',
            'size' => null,
            'scale' => null,
            'notnull' => false,
            'default' => 'NULL',
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ),
    ];

    const COLUMN_NAMES = [
        'id',
        'slug',
        'title',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'created_at',
        'updated_at',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'slug' => null,
        'title' => null,
        'content' => null,
        'seo_title' => 'NULL',
        'seo_description' => 'NULL',
        'seo_keywords' => 'NULL',
        'created_at' => 'current_timestamp()',
        'updated_at' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = 'id';

    const AUTOINC_SEQUENCE = null;
}
