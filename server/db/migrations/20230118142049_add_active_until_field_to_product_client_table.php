<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddActiveUntilFieldToProductClientTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('product_client');
        $table
            ->addColumn('expiration_date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->update();
    }
}
