<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180917165234 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL, CHANGE status status INT NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD product_id INT DEFAULT NULL, CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB04584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_62809DB04584665A ON order_items (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB04584665A');
        $this->addSql('DROP INDEX IDX_62809DB04584665A ON order_items');
        $this->addSql('ALTER TABLE order_items DROP product_id, CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE orders CHANGE status status INT NOT NULL, CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL');
    }
}
