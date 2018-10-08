<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181007055517 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_images (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, size INT NOT NULL, mime_type VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', position INT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EFF7741112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_images ADD CONSTRAINT FK_EFF7741112469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('DROP TABLE category_image');
        $this->addSql('ALTER TABLE orders CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL, CHANGE status status INT NOT NULL');
        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_image (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, file_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, size INT NOT NULL, mime_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, original_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, dimensions LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:simple_array)\', updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2D0E4B1612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_image ADD CONSTRAINT FK_2D0E4B1612469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('DROP TABLE category_images');
        $this->addSql('ALTER TABLE order_items CHANGE quantity quantity INT NOT NULL, CHANGE price price NUMERIC(12, 2) NOT NULL, CHANGE cost cost NUMERIC(12, 2) NOT NULL');
        $this->addSql('ALTER TABLE orders CHANGE status status INT NOT NULL, CHANGE is_paid is_paid TINYINT(1) NOT NULL, CHANGE amount amount NUMERIC(12, 2) NOT NULL');
    }
}
