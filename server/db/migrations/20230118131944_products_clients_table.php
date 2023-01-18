<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProductsClientsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('product_client', ['id' => 'product_client_id']);
        $table
            ->addColumn('product_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('client_id', 'integer', ['signed' => false, 'null' => false])
            ->addForeignKey('product_id', 'products', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->addForeignKey('client_id', 'clients', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->create();
    }
}
