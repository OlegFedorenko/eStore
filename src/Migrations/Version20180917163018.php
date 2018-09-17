<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180917163018 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders ADD status INT NOT NULL, DROP order_status, CHANGE payment_status is_paid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB0FCDAEAAA');
        $this->addSql('DROP INDEX IDX_62809DB0FCDAEAAA ON order_items');
        $this->addSql('ALTER TABLE order_items CHANGE `order` order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB08D9F6D38 FOREIGN KEY ("order") REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_62809DB08D9F6D38 ON order_items (order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB08D9F6D38');
        $this->addSql('DROP INDEX IDX_62809DB08D9F6D38 ON order_items');
        $this->addSql('ALTER TABLE order_items CHANGE order_id `order` INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB0FCDAEAAA FOREIGN KEY (`order`) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_62809DB0FCDAEAAA ON order_items (`order`)');
        $this->addSql('ALTER TABLE orders ADD order_status VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP status, CHANGE is_paid payment_status TINYINT(1) NOT NULL');
    }
}
