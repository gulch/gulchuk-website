<?php
declare(strict_types=1);

namespace App\DataSource\Article;

use Atlas\Mapper\Record;

/**
 * @method ArticleRow getRow()
 */
class ArticleRecord extends Record
{
    use ArticleFields;

    public function createdDateInFormat($format = 'j M Y'): string
    {
        $dateTime = new \DateTime($this->created_at);

        return $dateTime->format($format);
    }

    public function updatedDateInFormat($format = 'j M Y'): string
    {
        $dateTime = new \DateTime($this->updated_at);

        return $dateTime->format($format);
    }
}
