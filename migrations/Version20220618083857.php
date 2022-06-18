<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220618083857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes_classes (classes_source INT NOT NULL, classes_target INT NOT NULL, INDEX IDX_28AE26A173F98F88 (classes_source), INDEX IDX_28AE26A16A1CDF07 (classes_target), PRIMARY KEY(classes_source, classes_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classes_classes ADD CONSTRAINT FK_28AE26A173F98F88 FOREIGN KEY (classes_source) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_classes ADD CONSTRAINT FK_28AE26A16A1CDF07 FOREIGN KEY (classes_target) REFERENCES classes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE classes_classes');
    }
}
