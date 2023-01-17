<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ClientsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('client');
        $table
            ->addColumn('company', 'string')
            ->addColumn('fictional_name', 'string')
            ->addColumn('register_number', 'string')
            ->addColumn('zip_code', 'string')
            ->addColumn('address', 'string')
            ->addColumn('number', 'string')
            ->addColumn('district', 'string')
            ->addColumn('city', 'string')
            ->addColumn('state', 'string')
            ->addColumn('email', 'string')
            ->addColumn('phone', 'string')
            ->create();
    }
}
