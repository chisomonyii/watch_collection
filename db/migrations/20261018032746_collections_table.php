<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CollectionsTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the table already exists to prevent duplicate creation errors
        if (!$this->hasTable('collections')) {
            $table = $this->table('collections');

            $table->addColumn('name', 'string', ['limit' => 100, 'null' => false])
                  ->addColumn('slug', 'string', ['limit' => 100, 'null' => false])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addColumn('attributes', 'text', ['null' => true, 'default' => null])
                  ->addIndex(['slug'], ['unique' => true])
                  ->create();
        }
    }
}