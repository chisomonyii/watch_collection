<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePaymentsTable extends AbstractMigration
{
    public function change(): void
    {
        // Check if the payments table already exists to prevent duplicate creation errors
        if (!$this->hasTable('payments')) {
            $table = $this->table('payments');

            $table->addColumn('order_id', 'integer', ['null' => false])
                  ->addColumn('payment_gateway', 'string', ['limit' => 50, 'null' => false])
                  ->addColumn('gateway_reference', 'string', ['limit' => 100, 'null' => true, 'default' => null])
                  ->addColumn('amount_paid', 'decimal', ['precision' => 12, 'scale' => 2, 'null' => false])
                  ->addColumn('payment_status', 'string', ['limit' => 50, 'null' => true, 'default' => 'Pending'])
                  ->addColumn('paid_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['order_id'])
                  ->create();
        }
    }
}