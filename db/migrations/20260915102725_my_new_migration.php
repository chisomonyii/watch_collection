<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyNewMigration extends AbstractMigration
{
    public function change(): void
    {
        // Check if the users table already exists to prevent duplicate creation errors
        if (!$this->hasTable('users')) {
            $table = $this->table('users');

            $table->addColumn('firstname', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('lastname', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('email', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('password', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('role', 'enum', [
                      'values' => ['admin', 'staff'],
                      'null' => false,
                      'default' => 'staff'
                  ])
                  ->addColumn('status', 'enum', [
                      'values' => ['pending', 'approved', 'active', 'suspended'],
                      'null' => false,
                      'default' => 'pending'
                  ])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null, 'update' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['email'], ['unique' => true])
                  ->create();
        }
    }
}