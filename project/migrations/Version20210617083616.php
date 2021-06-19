<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617083616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agents_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE directions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE interventions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ordinateurs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pannes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE peripheriques_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE solutions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE techniciens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_fiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_ordinateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agents (id INT NOT NULL, service_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenoms VARCHAR(255) NOT NULL, contacts VARCHAR(10) DEFAULT NULL, email_perso VARCHAR(120) DEFAULT NULL, email_pro VARCHAR(120) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9596AB6EED5CA9E6 ON agents (service_id)');
        $this->addSql('CREATE TABLE directions (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, sigle VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_495867ECA4D60759 ON directions (libelle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_495867EC8776B952 ON directions (sigle)');
        $this->addSql('CREATE TABLE fiche (id INT NOT NULL, type_id INT NOT NULL, ordinateurs_id INT DEFAULT NULL, libelle VARCHAR(150) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C13CC78C54C8C93 ON fiche (type_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC789C42159C ON fiche (ordinateurs_id)');
        $this->addSql('CREATE TABLE interventions (id INT NOT NULL, ordinateur_id INT NOT NULL, diagnostique TEXT NOT NULL, observation TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5ADBAD7F828317CA ON interventions (ordinateur_id)');
        $this->addSql('CREATE TABLE interventions_techniciens (interventions_id INT NOT NULL, techniciens_id INT NOT NULL, PRIMARY KEY(interventions_id, techniciens_id))');
        $this->addSql('CREATE INDEX IDX_16F50EFE334423FF ON interventions_techniciens (interventions_id)');
        $this->addSql('CREATE INDEX IDX_16F50EFE656A0C96 ON interventions_techniciens (techniciens_id)');
        $this->addSql('CREATE TABLE ordinateurs (id INT NOT NULL, agent_id INT DEFAULT NULL, type_id INT NOT NULL, modele VARCHAR(100) NOT NULL, processeur VARCHAR(100) NOT NULL, frequence DOUBLE PRECISION DEFAULT NULL, ram DOUBLE PRECISION NOT NULL, type_ram TEXT DEFAULT NULL, disque INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A88D6BF3414710B ON ordinateurs (agent_id)');
        $this->addSql('CREATE INDEX IDX_A88D6BFC54C8C93 ON ordinateurs (type_id)');
        $this->addSql('COMMENT ON COLUMN ordinateurs.type_ram IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE pannes (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pannes_interventions (pannes_id INT NOT NULL, interventions_id INT NOT NULL, PRIMARY KEY(pannes_id, interventions_id))');
        $this->addSql('CREATE INDEX IDX_C057DB4252C4C5A1 ON pannes_interventions (pannes_id)');
        $this->addSql('CREATE INDEX IDX_C057DB42334423FF ON pannes_interventions (interventions_id)');
        $this->addSql('CREATE TABLE pannes_solutions (pannes_id INT NOT NULL, solutions_id INT NOT NULL, PRIMARY KEY(pannes_id, solutions_id))');
        $this->addSql('CREATE INDEX IDX_8FC7BFF52C4C5A1 ON pannes_solutions (pannes_id)');
        $this->addSql('CREATE INDEX IDX_8FC7BFF93DC645E ON pannes_solutions (solutions_id)');
        $this->addSql('CREATE TABLE peripheriques (id INT NOT NULL, agent_id INT NOT NULL, libelle VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_261995DF3414710B ON peripheriques (agent_id)');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, direction_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7332E169AF73D997 ON services (direction_id)');
        $this->addSql('CREATE TABLE solutions (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE techniciens (id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenoms VARCHAR(255) NOT NULL, contact VARCHAR(10) DEFAULT NULL, email VARCHAR(120) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_fiche (id INT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_ordinateur (id INT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6EED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78C54C8C93 FOREIGN KEY (type_id) REFERENCES type_fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC789C42159C FOREIGN KEY (ordinateurs_id) REFERENCES ordinateurs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE interventions ADD CONSTRAINT FK_5ADBAD7F828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateurs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE interventions_techniciens ADD CONSTRAINT FK_16F50EFE334423FF FOREIGN KEY (interventions_id) REFERENCES interventions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE interventions_techniciens ADD CONSTRAINT FK_16F50EFE656A0C96 FOREIGN KEY (techniciens_id) REFERENCES techniciens (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordinateurs ADD CONSTRAINT FK_A88D6BF3414710B FOREIGN KEY (agent_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordinateurs ADD CONSTRAINT FK_A88D6BFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_ordinateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pannes_interventions ADD CONSTRAINT FK_C057DB4252C4C5A1 FOREIGN KEY (pannes_id) REFERENCES pannes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pannes_interventions ADD CONSTRAINT FK_C057DB42334423FF FOREIGN KEY (interventions_id) REFERENCES interventions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pannes_solutions ADD CONSTRAINT FK_8FC7BFF52C4C5A1 FOREIGN KEY (pannes_id) REFERENCES pannes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pannes_solutions ADD CONSTRAINT FK_8FC7BFF93DC645E FOREIGN KEY (solutions_id) REFERENCES solutions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF3414710B FOREIGN KEY (agent_id) REFERENCES agents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169AF73D997 FOREIGN KEY (direction_id) REFERENCES directions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ordinateurs DROP CONSTRAINT FK_A88D6BF3414710B');
        $this->addSql('ALTER TABLE peripheriques DROP CONSTRAINT FK_261995DF3414710B');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E169AF73D997');
        $this->addSql('ALTER TABLE interventions_techniciens DROP CONSTRAINT FK_16F50EFE334423FF');
        $this->addSql('ALTER TABLE pannes_interventions DROP CONSTRAINT FK_C057DB42334423FF');
        $this->addSql('ALTER TABLE fiche DROP CONSTRAINT FK_4C13CC789C42159C');
        $this->addSql('ALTER TABLE interventions DROP CONSTRAINT FK_5ADBAD7F828317CA');
        $this->addSql('ALTER TABLE pannes_interventions DROP CONSTRAINT FK_C057DB4252C4C5A1');
        $this->addSql('ALTER TABLE pannes_solutions DROP CONSTRAINT FK_8FC7BFF52C4C5A1');
        $this->addSql('ALTER TABLE agents DROP CONSTRAINT FK_9596AB6EED5CA9E6');
        $this->addSql('ALTER TABLE pannes_solutions DROP CONSTRAINT FK_8FC7BFF93DC645E');
        $this->addSql('ALTER TABLE interventions_techniciens DROP CONSTRAINT FK_16F50EFE656A0C96');
        $this->addSql('ALTER TABLE fiche DROP CONSTRAINT FK_4C13CC78C54C8C93');
        $this->addSql('ALTER TABLE ordinateurs DROP CONSTRAINT FK_A88D6BFC54C8C93');
        $this->addSql('DROP SEQUENCE agents_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE directions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fiche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE interventions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ordinateurs_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pannes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE peripheriques_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE solutions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE techniciens_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_fiche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_ordinateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE agents');
        $this->addSql('DROP TABLE directions');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE interventions');
        $this->addSql('DROP TABLE interventions_techniciens');
        $this->addSql('DROP TABLE ordinateurs');
        $this->addSql('DROP TABLE pannes');
        $this->addSql('DROP TABLE pannes_interventions');
        $this->addSql('DROP TABLE pannes_solutions');
        $this->addSql('DROP TABLE peripheriques');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE solutions');
        $this->addSql('DROP TABLE techniciens');
        $this->addSql('DROP TABLE type_fiche');
        $this->addSql('DROP TABLE type_ordinateur');
        $this->addSql('DROP TABLE "user"');
    }
}
