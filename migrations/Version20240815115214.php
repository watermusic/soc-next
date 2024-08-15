<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240815115214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE soc_messenger_messages');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_232B318C69A91CE2');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_232B318C9C4C13F6');
        $this->addSql('DROP INDEX idx_232b318c69a91ce2 ON soc_game');
        $this->addSql('CREATE INDEX IDX_C4FBE6869A91CE2 ON soc_game (guest_team_id)');
        $this->addSql('DROP INDEX idx_232b318c9c4c13f6 ON soc_game');
        $this->addSql('CREATE INDEX IDX_C4FBE689C4C13F6 ON soc_game (home_team_id)');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_232B318C69A91CE2 FOREIGN KEY (guest_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_lineup DROP FOREIGN KEY FK_CD7E0ECAA76ED395');
        $this->addSql('DROP INDEX idx_cd7e0ecaa76ed395 ON soc_lineup');
        $this->addSql('CREATE INDEX IDX_8A6B89F7A76ED395 ON soc_lineup (user_id)');
        $this->addSql('ALTER TABLE soc_lineup ADD CONSTRAINT FK_CD7E0ECAA76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65DD842E46');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('DROP INDEX idx_98197a65dd842e46 ON soc_player');
        $this->addSql('CREATE INDEX IDX_DF0CFD58DD842E46 ON soc_player (position_id)');
        $this->addSql('DROP INDEX idx_98197a65a76ed395 ON soc_player');
        $this->addSql('CREATE INDEX IDX_DF0CFD58A76ED395 ON soc_player (user_id)');
        $this->addSql('DROP INDEX idx_98197a65296cd8ae ON soc_player');
        $this->addSql('CREATE INDEX IDX_DF0CFD58296CD8AE ON soc_player (team_id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65DD842E46 FOREIGN KEY (position_id) REFERENCES soc_position (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_score DROP FOREIGN KEY FK_32993751A76ED395');
        $this->addSql('DROP INDEX idx_32993751a76ed395 ON soc_score');
        $this->addSql('CREATE INDEX IDX_95D175BFA76ED395 ON soc_score (user_id)');
        $this->addSql('ALTER TABLE soc_score ADD CONSTRAINT FK_32993751A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_team ADD external_id VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX uniq_8d93d649e7927c74 ON soc_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2F759ADE7927C74 ON soc_user (email)');
        $this->addSql('ALTER TABLE sessions CHANGE sess_data sess_data LONGBLOB NOT NULL');
        $this->addSql('DROP INDEX sessions_sess_lifetime_idx ON sessions');
        $this->addSql('CREATE INDEX sess_lifetime_idx ON sessions (sess_lifetime)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soc_messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE soc_team DROP external_id');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_C4FBE6869A91CE2');
        $this->addSql('ALTER TABLE soc_game DROP FOREIGN KEY FK_C4FBE689C4C13F6');
        $this->addSql('DROP INDEX idx_c4fbe6869a91ce2 ON soc_game');
        $this->addSql('CREATE INDEX IDX_232B318C69A91CE2 ON soc_game (guest_team_id)');
        $this->addSql('DROP INDEX idx_c4fbe689c4c13f6 ON soc_game');
        $this->addSql('CREATE INDEX IDX_232B318C9C4C13F6 ON soc_game (home_team_id)');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_C4FBE6869A91CE2 FOREIGN KEY (guest_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_game ADD CONSTRAINT FK_C4FBE689C4C13F6 FOREIGN KEY (home_team_id) REFERENCES soc_team (id)');
        $this->addSql('ALTER TABLE soc_lineup DROP FOREIGN KEY FK_8A6B89F7A76ED395');
        $this->addSql('DROP INDEX idx_8a6b89f7a76ed395 ON soc_lineup');
        $this->addSql('CREATE INDEX IDX_CD7E0ECAA76ED395 ON soc_lineup (user_id)');
        $this->addSql('ALTER TABLE soc_lineup ADD CONSTRAINT FK_8A6B89F7A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_score DROP FOREIGN KEY FK_95D175BFA76ED395');
        $this->addSql('DROP INDEX idx_95d175bfa76ed395 ON soc_score');
        $this->addSql('CREATE INDEX IDX_32993751A76ED395 ON soc_score (user_id)');
        $this->addSql('ALTER TABLE soc_score ADD CONSTRAINT FK_95D175BFA76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('DROP INDEX uniq_a2f759ade7927c74 ON soc_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON soc_user (email)');
        $this->addSql('ALTER TABLE sessions CHANGE sess_data sess_data BLOB NOT NULL');
        $this->addSql('DROP INDEX sess_lifetime_idx ON sessions');
        $this->addSql('CREATE INDEX sessions_sess_lifetime_idx ON sessions (sess_lifetime)');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_DF0CFD58DD842E46');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_DF0CFD58A76ED395');
        $this->addSql('ALTER TABLE soc_player DROP FOREIGN KEY FK_DF0CFD58296CD8AE');
        $this->addSql('DROP INDEX idx_df0cfd58a76ed395 ON soc_player');
        $this->addSql('CREATE INDEX IDX_98197A65A76ED395 ON soc_player (user_id)');
        $this->addSql('DROP INDEX idx_df0cfd58296cd8ae ON soc_player');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON soc_player (team_id)');
        $this->addSql('DROP INDEX idx_df0cfd58dd842e46 ON soc_player');
        $this->addSql('CREATE INDEX IDX_98197A65DD842E46 ON soc_player (position_id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_DF0CFD58DD842E46 FOREIGN KEY (position_id) REFERENCES soc_position (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_DF0CFD58A76ED395 FOREIGN KEY (user_id) REFERENCES soc_user (id)');
        $this->addSql('ALTER TABLE soc_player ADD CONSTRAINT FK_DF0CFD58296CD8AE FOREIGN KEY (team_id) REFERENCES soc_team (id)');
    }
}
