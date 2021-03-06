<?php
declare(strict_types=1);

namespace App\DataSource\Tag;

use App\DataSource\DateTimestampsEvents;
use Atlas\Query\Delete;
use Atlas\Query\Insert;
use Atlas\Query\Select;
use Atlas\Query\Update;
use Atlas\Table\Row;
use Atlas\Table\Table;
use Atlas\Table\TableEvents;
use PDOStatement;

class TagTableEvents extends TableEvents
{
    use DateTimestampsEvents;
}
