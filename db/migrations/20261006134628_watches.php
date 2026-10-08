<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Watches extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('watches')
            ->addColumn('collection_id', 'integer', ['limit' => 11])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('price', 'decimal', ['precision'=> 10, 'scale'=> 2])
            ->addColumn('image_url', 'string', ['limit'=> 255])
            ->addColumn('ratin', 'decimal', ['precision'=> 2, 'scale'=> 1])
            ->addColumn('reviews_count', 'integer', ['limit'=> 11])
            ->addColumn('description', 'text')
            ->addColumn('in_stock', 'boolean')
            ->addColumn('is_featured', 'boolean')
            ->addTimestamps()
            ->create();

    }
}
