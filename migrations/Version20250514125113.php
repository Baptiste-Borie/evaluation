<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514125113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, descriptif LONGTEXT NOT NULL, consignes LONGTEXT DEFAULT NULL, position INT NOT NULL, INDEX IDX_285F75DD6E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, emetteur_id INT NOT NULL, destinataire_id INT NOT NULL, reponse_a_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_B6BD307F79E92E8C (emetteur_id), INDEX IDX_B6BD307FA4F84F6E (destinataire_id), UNIQUE INDEX UNIQ_B6BD307F7B51A1B (reponse_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendu_activite (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, validateur_id INT DEFAULT NULL, url_document VARCHAR(255) NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_88D477C960BB6FE6 (auteur_id), INDEX IDX_88D477C9E57AEF2F (validateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rendu_activite_etape (rendu_activite_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_99628E1419FF918B (rendu_activite_id), INDEX IDX_99628E144A8CA2AD (etape_id), PRIMARY KEY(rendu_activite_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, support VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, url_document_physique VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource_etape (ressource_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_BCCBF159FC6CD52A (ressource_id), INDEX IDX_BCCBF1594A8CA2AD (etape_id), PRIMARY KEY(ressource_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape ADD CONSTRAINT FK_285F75DD6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F79E92E8C FOREIGN KEY (emetteur_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7B51A1B FOREIGN KEY (reponse_a_id) REFERENCES message (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite ADD CONSTRAINT FK_88D477C960BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite ADD CONSTRAINT FK_88D477C9E57AEF2F FOREIGN KEY (validateur_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite_etape ADD CONSTRAINT FK_99628E1419FF918B FOREIGN KEY (rendu_activite_id) REFERENCES rendu_activite (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite_etape ADD CONSTRAINT FK_99628E144A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape ADD CONSTRAINT FK_BCCBF159FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape ADD CONSTRAINT FK_BCCBF1594A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD6E38C0DB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F79E92E8C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F7B51A1B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite DROP FOREIGN KEY FK_88D477C960BB6FE6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite DROP FOREIGN KEY FK_88D477C9E57AEF2F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite_etape DROP FOREIGN KEY FK_99628E1419FF918B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rendu_activite_etape DROP FOREIGN KEY FK_99628E144A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape DROP FOREIGN KEY FK_BCCBF159FC6CD52A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape DROP FOREIGN KEY FK_BCCBF1594A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etape
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parcours
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendu_activite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rendu_activite_etape
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource_etape
        SQL);
    }
}
