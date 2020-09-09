<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200909102749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, zipcode VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review RENAME INDEX coments_restaurant_fk TO IDX_73DCFA1A4E1F92E8');
        $this->addSql('ALTER TABLE restaurant ADD city_id INT NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD created_at DATETIME NOT NULL, DROP cp');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F8BAC62AF ON restaurant (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F8BAC62AF');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE review RENAME INDEX idx_73dcfa1a4e1f92e8 TO coments_restaurant_FK');
        $this->addSql('DROP INDEX IDX_EB95123F8BAC62AF ON restaurant');
        $this->addSql('ALTER TABLE restaurant ADD cp VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, DROP city_id, DROP description, DROP created_at');
    }
}
