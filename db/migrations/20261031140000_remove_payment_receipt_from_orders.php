<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RemovePaymentReceiptFromOrders extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('orders');
        
        // Check if the column exists before dropping it to prevent errors
        if ($table->hasColumn('payment_receipt')) {
            $table->removeColumn('payment_receipt');
        }
    }
}