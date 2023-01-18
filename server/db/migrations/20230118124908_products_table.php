<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProductsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('products');
        $table
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('description', 'string',  ['null' => false])
            ->addColumn('version', 'string',  ['null' => false])
            ->create(); 
    }
}
