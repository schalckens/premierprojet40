<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211130132748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe CHANGE idlieuv idLieu INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B95CAA23C7 FOREIGN KEY (idLieu) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B95CAA23C7 ON employe (idLieu)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B95CAA23C7');
        $this->addSql('DROP INDEX IDX_F804D3B95CAA23C7 ON employe');
        $this->addSql('ALTER TABLE employe CHANGE idlieu idLieuv INT NOT NULL');
    }
}
