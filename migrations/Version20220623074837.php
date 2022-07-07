<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623074837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial schema creation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soc_game (id INT AUTO_INCREMENT NOT NULL, guest_team_id INT NOT NULL, home_team_id INT NOT NULL, kick_off_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', match_day INT NOT NULL, INDEX IDX_232B318C69A91CE2 (guest_team_id), INDEX IDX_232B318C9C4C13F6 (home_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_lineup (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, matchday SMALLINT NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CD7E0ECAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_player (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, user_id INT DEFAULT NULL, team_id INT NOT NULL, name VARCHAR(255) NOT NULL, fee INT DEFAULT NULL, market_value INT NOT NULL, average_grade DOUBLE PRECISION NOT NULL, average_score DOUBLE PRECISION NOT NULL, thumb_url VARCHAR(255) DEFAULT NULL, INDEX IDX_98197A65DD842E46 (position_id), INDEX IDX_98197A65A76ED395 (user_id), INDEX IDX_98197A65296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shortcut VARCHAR(255) NOT NULL, color_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_score (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, match_day SMALLINT NOT NULL, score INT NOT NULL, INDEX IDX_32993751A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soc_messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_232B318C69A91CE2 FOREIGN KEY (guest_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_lineup ADD CONSTRAINT FK_CD7E0ECAA76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65DD842E46 FOREIGN KEY (position_id) REFERENCES soc_position (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_score ADD CONSTRAINT FK_32993751A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65DD842E46');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_232B318C69A91CE2');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE soc_lineup DROP FOREIGN KEY FK_CD7E0ECAA76ED395');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE soc_score DROP FOREIGN KEY FK_32993751A76ED395');
        $this->addSql('DROP TABLE soc_game');
        $this->addSql('DROP TABLE soc_lineup');
        $this->addSql('DROP TABLE soc_player');
        $this->addSql('DROP TABLE soc_position');
        $this->addSql('DROP TABLE soc_score');
        $this->addSql('DROP TABLE soc_team');
        $this->addSql('DROP TABLE soc_user');
        $this->addSql('DROP TABLE soc_messenger_messages');
    }
}
