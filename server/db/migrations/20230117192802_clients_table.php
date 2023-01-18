<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ClientsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('clients');
        $table
            ->addColumn('company', 'string', ['null' => false])
            ->addColumn('fictional_name', 'string', ['null' => false])
            ->addColumn('register_number', 'string', ['null' => false])
            ->addColumn('zip_code', 'string', ['null' => false])
            ->addColumn('address', 'string', ['null' => false])
            ->addColumn('number', 'string', ['null' => false])
            ->addColumn('district', 'string', ['null' => false])
            ->addColumn('city', 'string', ['null' => false])
            ->addColumn('state', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addColumn('phone', 'string', ['null' => false])
            ->create();
    }
}
