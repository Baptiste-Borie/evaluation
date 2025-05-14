<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514134555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_99B1DEE3A76ED395 ON parcours (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_99B1DEE3A76ED395 ON parcours
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parcours DROP user_id
        SQL);
    }
}
