<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010181257 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL, CHANGE status status INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE orders CHANGE status status INT NOT NULL, CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE users DROP phone');
    }
}
