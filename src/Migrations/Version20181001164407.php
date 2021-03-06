<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181001164407 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_images (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, size INT NOT NULL, mime_type VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, dimensions VARCHAR(255) DEFAULT NULL, position INT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8263FFCE4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCE4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL, CHANGE status status INT NOT NULL');
        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_images');
        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE orders CHANGE status status INT NOT NULL, CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL');
    }
}
