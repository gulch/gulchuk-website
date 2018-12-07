<?php
declare(strict_types=1);

namespace App\DataSource\ArticleTag;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method ArticleTagTable getTable()
 * @method ArticleTagRelationships getRelationships()
 * @method ArticleTagRecord|null fetchRecord($primaryVal, array $with = [])
 * @method ArticleTagRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method ArticleTagRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method ArticleTagRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method ArticleTagRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method ArticleTagRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method ArticleTagSelect select(array $whereEquals = [])
 * @method ArticleTagRecord newRecord(array $fields = [])
 * @method ArticleTagRecord[] newRecords(array $fieldSets)
 * @method ArticleTagRecordSet newRecordSet(array $records = [])
 * @method ArticleTagRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method ArticleTagRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class ArticleTag extends Mapper
{
}
