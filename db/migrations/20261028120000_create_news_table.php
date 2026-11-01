<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNewsTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the news table already exists to prevent duplicate creation errors
        if (!$this->hasTable('news')) {
            $table = $this->table('news');

            $table->addColumn('title', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('slug', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('category', 'string', ['limit' => 50, 'null' => false, 'default' => 'Horology'])
                  ->addColumn('author_name', 'string', ['limit' => 100, 'null' => false])
                  ->addColumn('author_avatar', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('summary', 'text', ['null' => false])
                  ->addColumn('content', 'text', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG, 'null' => false])
                  ->addColumn('image_url', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('status', 'enum', ['values' => ['draft', 'published'], 'null' => false, 'default' => 'draft'])
                  ->addColumn('is_featured', 'boolean', ['null' => true, 'default' => 0])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['slug'], ['unique' => true])
                  ->create();
        }
    }
}