<?php
declare(strict_types=1);

namespace App\DataSource\Tag;

use Atlas\Mapper\Record;
use App\DataSource\DateInFormat;

/**
 * @method TagRow getRow()
 */
class TagRecord extends Record
{
    use TagFields, DateInFormat;

    public function articlesCount(): int
    {
        return \count($this->articles);
    }
}
