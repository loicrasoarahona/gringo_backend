<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211203311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce_commentaire (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, annonce_id INT NOT NULL, date DATETIME NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_135FCEF3FB88E14F (utilisateur_id), INDEX IDX_135FCEF38805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_evaluation (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, annonce_id INT NOT NULL, score DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_D5770F6FB88E14F (utilisateur_id), INDEX IDX_D5770F68805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_commentaire ADD CONSTRAINT FK_135FCEF3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE annonce_commentaire ADD CONSTRAINT FK_135FCEF38805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE annonce_evaluation ADD CONSTRAINT FK_D5770F6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE annonce_evaluation ADD CONSTRAINT FK_D5770F68805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_commentaire DROP FOREIGN KEY FK_135FCEF3FB88E14F');
        $this->addSql('ALTER TABLE annonce_commentaire DROP FOREIGN KEY FK_135FCEF38805AB2F');
        $this->addSql('ALTER TABLE annonce_evaluation DROP FOREIGN KEY FK_D5770F6FB88E14F');
        $this->addSql('ALTER TABLE annonce_evaluation DROP FOREIGN KEY FK_D5770F68805AB2F');
        $this->addSql('DROP TABLE annonce_commentaire');
        $this->addSql('DROP TABLE annonce_evaluation');
    }
}
