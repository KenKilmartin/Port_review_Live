<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180404012322 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE port (id INT AUTO_INCREMENT NOT NULL, port_name VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, price_range INT NOT NULL, is_public TINYINT(1) NOT NULL, date DATETIME NOT NULL, does_user_want_to_make_public TINYINT(1) NOT NULL, reviewed_by VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, port_id INT DEFAULT NULL, review VARCHAR(255) NOT NULL, place_of_purchase VARCHAR(255) NOT NULL, price_paid DOUBLE PRECISION NOT NULL, num_of_stars NUMERIC(10, 1) NOT NULL, user VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, is_public TINYINT(1) NOT NULL, votes INT DEFAULT 0, does_user_want_to_make_public TINYINT(1) NOT NULL, INDEX IDX_794381C676E92A9C (port_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', UNIQUE INDEX UNIQ_C2502824F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C676E92A9C FOREIGN KEY (port_id) REFERENCES port (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C676E92A9C');
        $this->addSql('DROP TABLE port');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE app_users');
    }
}
