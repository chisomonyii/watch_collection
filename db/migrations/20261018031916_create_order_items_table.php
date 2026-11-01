<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrderItemsTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the order_items table already exists to prevent duplicate creation errors
        if (!$this->hasTable('order_items')) {
            $table = $this->table('order_items');

            $table->addColumn('order_id', 'integer', ['null' => false])
                  ->addColumn('watch_id', 'string', ['limit' => 50, 'null' => false])
                  ->addColumn('watch_name', 'string', ['limit' => 255, 'null' => false])
                  ->addColumn('brand', 'string', ['limit' => 100, 'null' => false])
                  ->addColumn('price', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => false])
                  ->addColumn('quantity', 'integer', ['null' => false])
                  ->addColumn('strap_variant', 'string', ['limit' => 50, 'null' => true, 'default' => 'Steel'])
                  ->addIndex(['order_id'])
                  ->create();
        }
    }
}