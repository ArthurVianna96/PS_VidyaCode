<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TriggerForPreventingProductDeletion extends AbstractMigration
{
    public function change(): void
    {
        $this->execute(
            "CREATE TRIGGER PRODUCT_DELETE
            BEFORE DELETE ON products
            FOR EACH ROW
            BEGIN
                IF OLD.id IN (
                    SELECT product_id FROM product_client WHERE product_id = OLD.id
                ) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Product cannot be deleted';
                END IF;
            END
            "
        );
    }
}
