<?php
declare(strict_types=1);

namespace App\DataSource\ArticleTag;

use Atlas\Mapper\RecordSet;

/**
 * @method ArticleTagRecord offsetGet($offset)
 * @method ArticleTagRecord appendNew(array $fields = [])
 * @method ArticleTagRecord|null getOneBy(array $whereEquals)
 * @method ArticleTagRecordSet getAllBy(array $whereEquals)
 * @method ArticleTagRecord|null detachOneBy(array $whereEquals)
 * @method ArticleTagRecordSet detachAllBy(array $whereEquals)
 * @method ArticleTagRecordSet detachAll()
 * @method ArticleTagRecordSet detachDeleted()
 */
class ArticleTagRecordSet extends RecordSet
{
}
