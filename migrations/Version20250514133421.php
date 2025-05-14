<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514133421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape DROP FOREIGN KEY FK_BCCBF1594A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape DROP FOREIGN KEY FK_BCCBF159FC6CD52A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource_etape
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource ADD etape_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource ADD CONSTRAINT FK_939F45444A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_939F45444A8CA2AD ON ressource (etape_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource_etape (ressource_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_BCCBF159FC6CD52A (ressource_id), INDEX IDX_BCCBF1594A8CA2AD (etape_id), PRIMARY KEY(ressource_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape ADD CONSTRAINT FK_BCCBF1594A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource_etape ADD CONSTRAINT FK_BCCBF159FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource DROP FOREIGN KEY FK_939F45444A8CA2AD
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_939F45444A8CA2AD ON ressource
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ressource DROP etape_id
        SQL);
    }
}
