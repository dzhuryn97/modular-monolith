<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204195213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "account" (id UUID NOT NULL, money_amount INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "account".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "user" DROP money_amount');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "account"');
        $this->addSql('ALTER TABLE "user" ADD money_amount INT NOT NULL');
    }
}
