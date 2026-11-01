<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateContactTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the table already exists to prevent duplicate creation errors
        if (!$this->hasTable('contact')) {
            $table = $this->table('contact');
            
            $table->addColumn('name', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('email', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('phone', 'string', ['limit' => 20, 'null' => true, 'default' => null])
                  ->addColumn('message', 'text', ['null' => false])
                  ->addColumn('status', 'string', ['limit' => 50, 'null' => false, 'default' => 'unread'])
                  ->addColumn('createdAt', 'datetime', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addColumn('updatedAt', 'datetime', ['null' => true, 'default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
                  ->create();
        }
    }
}