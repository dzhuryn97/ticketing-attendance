<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810145430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket (id UUID NOT NULL, event_id UUID NOT NULL, code VARCHAR(255) NOT NULL, used_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN ticket.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN ticket.event_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN ticket.used_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('CREATE TABLE inbox_messages (inbox_message_id UUID NOT NULL, content TEXT NOT NULL, occurred_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, rejected_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, processed_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(inbox_message_id))');
        $this->addSql('COMMENT ON COLUMN inbox_messages.inbox_message_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN inbox_messages.occurred_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN inbox_messages.delivered_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN inbox_messages.rejected_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN inbox_messages.processed_on IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE inbox_messages');
    }
}
