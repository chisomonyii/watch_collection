<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSubscribersTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the subscribers table already exists to prevent duplicate creation errors
        if (!$this->hasTable('subscribers')) {
            $table = $this->table('subscribers');

            $table->addColumn('name', 'string', ['limit' => 100, 'null' => true, 'default' => null])
                  ->addColumn('email', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('interest', 'string', ['limit' => 100, 'null' => true, 'default' => 'All Watches'])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['email'], ['unique' => true])
                  ->create();
        }
    }
}