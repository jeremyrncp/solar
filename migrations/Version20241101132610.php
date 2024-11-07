<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241101132610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE solar_data (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, production INT NOT NULL, co2 INT NOT NULL, threes INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_A7B532929395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE solar_data ADD CONSTRAINT FK_A7B532929395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE solar_data DROP FOREIGN KEY FK_A7B532929395C3F3');
        $this->addSql('DROP TABLE solar_data');
    }
}
