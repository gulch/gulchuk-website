<?php
declare(strict_types=1);

namespace App\DataSource\ArticleTag;

use Atlas\Mapper\Record;

/**
 * @method ArticleTagRow getRow()
 */
class ArticleTagRecord extends Record
{
    use ArticleTagFields;
}
