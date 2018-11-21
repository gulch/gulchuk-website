<?php
declare(strict_types=1);

namespace App\DataSource\Article;

use Atlas\Mapper\RecordSet;

/**
 * @method ArticleRecord offsetGet($offset)
 * @method ArticleRecord appendNew(array $fields = [])
 * @method ArticleRecord|null getOneBy(array $whereEquals)
 * @method ArticleRecordSet getAllBy(array $whereEquals)
 * @method ArticleRecord|null detachOneBy(array $whereEquals)
 * @method ArticleRecordSet detachAllBy(array $whereEquals)
 * @method ArticleRecordSet detachAll()
 * @method ArticleRecordSet detachDeleted()
 */
class ArticleRecordSet extends RecordSet
{
}
