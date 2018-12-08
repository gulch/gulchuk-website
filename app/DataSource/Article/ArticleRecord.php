<?php
declare(strict_types=1);

namespace App\DataSource\Article;

use Atlas\Mapper\Record;
use App\DataSource\DateInFormat;

/**
 * @method ArticleRow getRow()
 */
class ArticleRecord extends Record
{
    use ArticleFields, DateInFormat;
}
