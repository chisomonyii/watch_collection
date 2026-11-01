<?php

use Phinx\Migration\AbstractMigration;

class CreatePasswordResetsTable extends AbstractMigration
{
    public function change()
    {
        // Check if the password_resets table already exists to prevent duplicate creation errors
        if (!$this->hasTable('password_resets')) {
            // Create the password_resets table
            $table = $this->table('password_resets', ['id' => true, 'primary_key' => ['id']]);
            
            $table->addColumn('email', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('token', 'string', ['limit' => 64, 'null' => false])
                  ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
                  ->addIndex(['email'], ['unique' => false])
                  ->create();
        }
    }
}