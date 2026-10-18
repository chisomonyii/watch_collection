<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateWatchesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('watches');

        $table->addColumn('collection_id', 'integer', ['null' => false])
              ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => false])
              ->addColumn('rating', 'decimal', ['precision' => 2, 'scale' => 1, 'null' => true, 'default' => 5.0])
              ->addColumn('reviews_count', 'integer', ['null' => true, 'default' => 0])
              ->addColumn('description', 'text', ['null' => true, 'default' => null])
              ->addColumn('strap', 'text', ['null' => true, 'default' => null])
              ->addColumn('manual_file', 'string', ['limit' => 255, 'null' => true, 'default' => 'default-watch-manual.pdf'])
              ->addColumn('in_stock', 'boolean', ['null' => true, 'default' => 1])
              ->addColumn('is_featured', 'boolean', ['null' => true, 'default' => 0])
              ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('stock', 'integer', ['null' => false, 'default' => 10])
              ->addColumn('image_url_1', 'string', ['limit' => 255, 'null' => true, 'default' => null])
              ->addColumn('image_url_2', 'string', ['limit' => 255, 'null' => true, 'default' => null])
              ->addColumn('image_url_3', 'string', ['limit' => 255, 'null' => true, 'default' => null])
              ->addColumn('image_url_4', 'string', ['limit' => 255, 'null' => true, 'default' => null])
              ->addIndex(['collection_id'])
              ->create();
    }
}