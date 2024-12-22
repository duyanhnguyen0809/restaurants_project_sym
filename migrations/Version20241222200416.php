<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222200416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE menu DROP description, CHANGE price price NUMERIC(10, 2) NOT NULL');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD customer_name VARCHAR(255) NOT NULL, DROP user_id, DROP time');
        $this->addSql('ALTER TABLE restaurant ADD location VARCHAR(255) NOT NULL, DROP address, DROP phone, DROP email, CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE `table` CHANGE seats capacity INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `table` CHANGE capacity seats INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD description VARCHAR(255) NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD phone VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE location address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL, ADD time TIME NOT NULL, DROP customer_name');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
    }
}
