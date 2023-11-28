<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113063042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement_utilisateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, abonnement_id INT NOT NULL, expiration DATETIME NOT NULL, UNIQUE INDEX UNIQ_EB378F92FB88E14F (utilisateur_id), INDEX IDX_EB378F92F1D74413 (abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, type_vehicule_id INT DEFAULT NULL, ville_id INT NOT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, comune VARCHAR(255) DEFAULT NULL, nb_places INT NOT NULL, telephone VARCHAR(255) NOT NULL, whatsapp VARCHAR(255) DEFAULT NULL, avec_chauffeur TINYINT(1) NOT NULL, chauffeur_obligatoire TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_F65593E5153E280 (type_vehicule_id), INDEX IDX_F65593E5A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_photo (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, filename VARCHAR(255) NOT NULL, priorite INT DEFAULT NULL, INDEX IDX_33A4F878805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boost_annonce (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, plan_boost_id INT NOT NULL, expiration DATETIME NOT NULL, UNIQUE INDEX UNIQ_AF3FB9A38805AB2F (annonce_id), INDEX IDX_AF3FB9A3BEFA7FA0 (plan_boost_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_boost (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_vehicule (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_ville (utilisateur_id INT NOT NULL, ville_id INT NOT NULL, INDEX IDX_8506811DFB88E14F (utilisateur_id), INDEX IDX_8506811DA73F0036 (ville_id), PRIMARY KEY(utilisateur_id, ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement_utilisateur ADD CONSTRAINT FK_EB378F92FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE abonnement_utilisateur ADD CONSTRAINT FK_EB378F92F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5153E280 FOREIGN KEY (type_vehicule_id) REFERENCES type_vehicule (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE annonce_photo ADD CONSTRAINT FK_33A4F878805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE boost_annonce ADD CONSTRAINT FK_AF3FB9A38805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE boost_annonce ADD CONSTRAINT FK_AF3FB9A3BEFA7FA0 FOREIGN KEY (plan_boost_id) REFERENCES plan_boost (id)');
        $this->addSql('ALTER TABLE utilisateur_ville ADD CONSTRAINT FK_8506811DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_ville ADD CONSTRAINT FK_8506811DA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD telephone VARCHAR(255) NOT NULL, ADD whatsapp VARCHAR(255) DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement_utilisateur DROP FOREIGN KEY FK_EB378F92FB88E14F');
        $this->addSql('ALTER TABLE abonnement_utilisateur DROP FOREIGN KEY FK_EB378F92F1D74413');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5153E280');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A73F0036');
        $this->addSql('ALTER TABLE annonce_photo DROP FOREIGN KEY FK_33A4F878805AB2F');
        $this->addSql('ALTER TABLE boost_annonce DROP FOREIGN KEY FK_AF3FB9A38805AB2F');
        $this->addSql('ALTER TABLE boost_annonce DROP FOREIGN KEY FK_AF3FB9A3BEFA7FA0');
        $this->addSql('ALTER TABLE utilisateur_ville DROP FOREIGN KEY FK_8506811DFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_ville DROP FOREIGN KEY FK_8506811DA73F0036');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE abonnement_utilisateur');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_photo');
        $this->addSql('DROP TABLE boost_annonce');
        $this->addSql('DROP TABLE plan_boost');
        $this->addSql('DROP TABLE type_vehicule');
        $this->addSql('DROP TABLE utilisateur_ville');
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE utilisateur DROP nom, DROP prenom, DROP telephone, DROP whatsapp, DROP logo');
    }
}
