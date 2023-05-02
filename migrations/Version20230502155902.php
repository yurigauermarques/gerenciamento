<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502155902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE aplicacao_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bezerro_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE estacao_monta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etapa_estacao_monta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matriz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pesagem_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE re_cria_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE res_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE aplicacao (id INT NOT NULL, res_id INT NOT NULL, data DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4DEA6774670E604 ON aplicacao (res_id)');
        $this->addSql('CREATE TABLE aplicacao_produto (aplicacao_id INT NOT NULL, produto_id INT NOT NULL, PRIMARY KEY(aplicacao_id, produto_id))');
        $this->addSql('CREATE INDEX IDX_FE4B72B1AEC95F8D ON aplicacao_produto (aplicacao_id)');
        $this->addSql('CREATE INDEX IDX_FE4B72B1105CFD56 ON aplicacao_produto (produto_id)');
        $this->addSql('CREATE TABLE bezerro (id INT NOT NULL, res_id INT NOT NULL, matriz_id INT DEFAULT NULL, etapa_estacao_monta_id INT DEFAULT NULL, data_desmama DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F19738874670E604 ON bezerro (res_id)');
        $this->addSql('CREATE INDEX IDX_F19738879C36C ON bezerro (matriz_id)');
        $this->addSql('CREATE INDEX IDX_F19738878CC8646 ON bezerro (etapa_estacao_monta_id)');
        $this->addSql('CREATE TABLE estacao_monta (id INT NOT NULL, titulo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etapa_estacao_monta (id INT NOT NULL, estacao_monta_id INT NOT NULL, tipo VARCHAR(11) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14A6E330C9939FC9 ON etapa_estacao_monta (estacao_monta_id)');
        $this->addSql('CREATE TABLE etapa_estacao_monta_matriz (etapa_estacao_monta_id INT NOT NULL, matriz_id INT NOT NULL, PRIMARY KEY(etapa_estacao_monta_id, matriz_id))');
        $this->addSql('CREATE INDEX IDX_F7A1A1E08CC8646 ON etapa_estacao_monta_matriz (etapa_estacao_monta_id)');
        $this->addSql('CREATE INDEX IDX_F7A1A1E09C36C ON etapa_estacao_monta_matriz (matriz_id)');
        $this->addSql('CREATE TABLE matriz (id INT NOT NULL, res_id INT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_163D20E34670E604 ON matriz (res_id)');
        $this->addSql('CREATE TABLE pesagem (id INT NOT NULL, res_id INT NOT NULL, data DATE NOT NULL, peso DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_72C4C4674670E604 ON pesagem (res_id)');
        $this->addSql('CREATE TABLE produto (id INT NOT NULL, nome VARCHAR(255) NOT NULL, observacao TEXT DEFAULT NULL, categoria VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE re_cria (id INT NOT NULL, res_id INT NOT NULL, previsao_abate DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F48DBD7C4670E604 ON re_cria (res_id)');
        $this->addSql('CREATE TABLE res (id INT NOT NULL, numero INT NOT NULL, data_nascimento DATE NOT NULL, sexo VARCHAR(1) NOT NULL, situcao VARCHAR(5) NOT NULL, observacao TEXT DEFAULT NULL, status VARCHAR(9) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE aplicacao ADD CONSTRAINT FK_D4DEA6774670E604 FOREIGN KEY (res_id) REFERENCES res (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE aplicacao_produto ADD CONSTRAINT FK_FE4B72B1AEC95F8D FOREIGN KEY (aplicacao_id) REFERENCES aplicacao (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE aplicacao_produto ADD CONSTRAINT FK_FE4B72B1105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bezerro ADD CONSTRAINT FK_F19738874670E604 FOREIGN KEY (res_id) REFERENCES res (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bezerro ADD CONSTRAINT FK_F19738879C36C FOREIGN KEY (matriz_id) REFERENCES matriz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bezerro ADD CONSTRAINT FK_F19738878CC8646 FOREIGN KEY (etapa_estacao_monta_id) REFERENCES etapa_estacao_monta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etapa_estacao_monta ADD CONSTRAINT FK_14A6E330C9939FC9 FOREIGN KEY (estacao_monta_id) REFERENCES estacao_monta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etapa_estacao_monta_matriz ADD CONSTRAINT FK_F7A1A1E08CC8646 FOREIGN KEY (etapa_estacao_monta_id) REFERENCES etapa_estacao_monta (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etapa_estacao_monta_matriz ADD CONSTRAINT FK_F7A1A1E09C36C FOREIGN KEY (matriz_id) REFERENCES matriz (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matriz ADD CONSTRAINT FK_163D20E34670E604 FOREIGN KEY (res_id) REFERENCES res (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pesagem ADD CONSTRAINT FK_72C4C4674670E604 FOREIGN KEY (res_id) REFERENCES res (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE re_cria ADD CONSTRAINT FK_F48DBD7C4670E604 FOREIGN KEY (res_id) REFERENCES res (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE aplicacao_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bezerro_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE estacao_monta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etapa_estacao_monta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE matriz_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pesagem_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produto_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE re_cria_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE res_id_seq CASCADE');
        $this->addSql('ALTER TABLE aplicacao DROP CONSTRAINT FK_D4DEA6774670E604');
        $this->addSql('ALTER TABLE aplicacao_produto DROP CONSTRAINT FK_FE4B72B1AEC95F8D');
        $this->addSql('ALTER TABLE aplicacao_produto DROP CONSTRAINT FK_FE4B72B1105CFD56');
        $this->addSql('ALTER TABLE bezerro DROP CONSTRAINT FK_F19738874670E604');
        $this->addSql('ALTER TABLE bezerro DROP CONSTRAINT FK_F19738879C36C');
        $this->addSql('ALTER TABLE bezerro DROP CONSTRAINT FK_F19738878CC8646');
        $this->addSql('ALTER TABLE etapa_estacao_monta DROP CONSTRAINT FK_14A6E330C9939FC9');
        $this->addSql('ALTER TABLE etapa_estacao_monta_matriz DROP CONSTRAINT FK_F7A1A1E08CC8646');
        $this->addSql('ALTER TABLE etapa_estacao_monta_matriz DROP CONSTRAINT FK_F7A1A1E09C36C');
        $this->addSql('ALTER TABLE matriz DROP CONSTRAINT FK_163D20E34670E604');
        $this->addSql('ALTER TABLE pesagem DROP CONSTRAINT FK_72C4C4674670E604');
        $this->addSql('ALTER TABLE re_cria DROP CONSTRAINT FK_F48DBD7C4670E604');
        $this->addSql('DROP TABLE aplicacao');
        $this->addSql('DROP TABLE aplicacao_produto');
        $this->addSql('DROP TABLE bezerro');
        $this->addSql('DROP TABLE estacao_monta');
        $this->addSql('DROP TABLE etapa_estacao_monta');
        $this->addSql('DROP TABLE etapa_estacao_monta_matriz');
        $this->addSql('DROP TABLE matriz');
        $this->addSql('DROP TABLE pesagem');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE re_cria');
        $this->addSql('DROP TABLE res');
    }
}
