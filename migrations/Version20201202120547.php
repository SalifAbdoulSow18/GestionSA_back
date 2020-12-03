<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202120547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C3959A3A4D60759 ON groupe_competence (libelle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C29552EA4D60759 ON groupe_tag (libelle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B76C2029A4D60759 ON referentiel (libelle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783A4D60759 ON tag (libelle)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2C3959A3A4D60759 ON groupe_competence');
        $this->addSql('DROP INDEX UNIQ_8C29552EA4D60759 ON groupe_tag');
        $this->addSql('DROP INDEX UNIQ_B76C2029A4D60759 ON referentiel');
        $this->addSql('DROP INDEX UNIQ_389B783A4D60759 ON tag');
    }
}
