<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404092554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE county (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, name, num_of_rooms, swimming_pool FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, county_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, num_of_rooms INTEGER NOT NULL, swimming_pool BOOLEAN NOT NULL, CONSTRAINT FK_3535ED985E73F45 FOREIGN KEY (county_id) REFERENCES county (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO hotel (id, name, num_of_rooms, swimming_pool) SELECT id, name, num_of_rooms, swimming_pool FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
        $this->addSql('CREATE INDEX IDX_3535ED985E73F45 ON hotel (county_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE county');
        $this->addSql('DROP INDEX IDX_3535ED985E73F45');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, name, num_of_rooms, swimming_pool FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, num_of_rooms INTEGER NOT NULL, swimming_pool BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO hotel (id, name, num_of_rooms, swimming_pool) SELECT id, name, num_of_rooms, swimming_pool FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
    }
}
