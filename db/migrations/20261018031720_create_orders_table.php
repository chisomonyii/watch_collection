<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrdersTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the table already exists to prevent duplicate creation errors
        if (!$this->hasTable('orders')) {
            $table = $this->table('orders');

            $table->addColumn('order_number', 'string', ['limit' => 50, 'null' => false])
                  ->addColumn('full_name', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('email', 'string', ['limit' => 150, 'null' => false])
                  ->addColumn('phone', 'string', ['limit' => 20, 'null' => false])
                  ->addColumn('address', 'text', ['null' => false])
                  ->addColumn('delivery_instructions', 'text', ['null' => true, 'default' => null])
                  ->addColumn('subtotal', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => false])
                  ->addColumn('shipping_fee', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => true, 'default' => 0.00])
                  ->addColumn('total_amount', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => false])
                  ->addColumn('shipping_method_name', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addColumn('order_status', 'enum', [
                      'values' => ['Pending Verification', 'Processing', 'Dispatched', 'Delivered', 'Cancelled'],
                      'null' => false,
                      'default' => 'Pending Verification'
                  ])
                  ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addColumn('payment_status', 'string', ['limit' => 50, 'null' => true, 'default' => 'Pending'])
                  ->addColumn('payment_reference', 'string', ['limit' => 255, 'null' => true, 'default' => null])
                  ->addIndex(['order_number'], ['unique' => true])
                  ->create();
        }
    }
}