<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateShippingMethodsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('shipping_methods');

        $table->addColumn('method_name', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('description', 'text', ['null' => true, 'default' => null])
              ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => false])
              ->addColumn('is_active', 'boolean', ['null' => true, 'default' => 1])
              ->create();
    }
}