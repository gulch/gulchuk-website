<?php
declare(strict_types=1);

namespace App\DataSource\Article;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method ArticleTable getTable()
 * @method ArticleRelationships getRelationships()
 * @method ArticleRecord|null fetchRecord($primaryVal, array $with = [])
 * @method ArticleRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method ArticleRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method ArticleRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method ArticleRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method ArticleRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method ArticleSelect select(array $whereEquals = [])
 * @method ArticleRecord newRecord(array $fields = [])
 * @method ArticleRecord[] newRecords(array $fieldSets)
 * @method ArticleRecordSet newRecordSet(array $records = [])
 * @method ArticleRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method ArticleRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Article extends Mapper
{
}
