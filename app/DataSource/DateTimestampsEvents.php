<?php
declare(strict_types=1);

namespace App\DataSource;

use Atlas\Table\Row;
use Atlas\Table\Table;

trait DateTimestampsEvents
{
    public function beforeInsertRow(Table $table, Row $row): ?array
    {
        $row->created_at = date('Y-m-d H:i:s');

        return null;
    }

    public function beforeUpdateRow(Table $table, Row $row): ?array
    {
        $row->updated_at = date('Y-m-d H:i:s');

        return null;
    }
}