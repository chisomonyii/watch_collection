<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateReviewsTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the reviews table already exists to prevent duplicate creation errors
        if (!$this->hasTable('reviews')) {
            $table = $this->table('reviews');

            $table->addColumn('order_id', 'integer', ['null' => true, 'default' => null])
                  ->addColumn('customer_name', 'string', ['limit' => 100, 'null' => false])
                  ->addColumn('title', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('comment', 'text', ['null' => false])
                  ->addColumn('rating', 'integer', ['null' => true, 'default' => 5])
                  ->addColumn('image_url', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('is_featured', 'boolean', ['null' => true, 'default' => 0])
                  ->addColumn('status', 'enum', [
                      'values' => ['pending', 'approved', 'rejected'],
                      'null' => true,
                      'default' => 'pending'
                  ])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['order_id'])
                  ->create();
        }
    }
}