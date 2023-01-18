<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class StoredProcedureForExpirationDate extends AbstractMigration
{
    public function change(): void
    {
        $this->execute('DROP PROCEDURE IF EXISTS STP_ATUALIZAVALIDADE_CLIENTE');
        $this->execute(
            'CREATE PROCEDURE STP_ATUALIZAVALIDADE_CLIENTE(IN id INT, IN days INT)
            BEGIN
            UPDATE product_client SET expiration_date = DATE_ADD(expiration_date, INTERVAL days DAY) WHERE client_id = id;
            END' 
        );
    }
}
