<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101144303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB4059D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB4059D86650F ON user_profile (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT FK_D95AB4059D86650F');
        $this->addSql('DROP INDEX UNIQ_D95AB4059D86650F');
        $this->addSql('ALTER TABLE user_profile DROP user_id_id');
    }
}
