<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160411211332 extends AbstractMigration
{
    private $conversation = 'fos_message_conversations';
    private $conversationPerson = 'fos_message_conversations_persons';
    private $conversationPersonTag = 'fos_message_conversations_persons_tags';
    private $message = 'fos_message_messages';
    private $messagePerson = 'fos_message_messages_persons';
    private $messageTag = 'fos_message_tags';

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $userSchemaName = 'fos_user';

        $conversationSchema = $schema->createTable($this->conversation);
        $conversationSchema->addColumn('id','integer', ['autoincrement' => true]);
        $conversationSchema->addColumn('subject', 'string', ['notnull' => false]);
        $conversationSchema->setPrimaryKey(['id']);

        $conversationPersonSchema = $schema->createTable($this->conversationPerson);
        $conversationPersonSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $conversationPersonSchema->addColumn('conversation_id', 'integer', ['notnull' => false]);
        $conversationPersonSchema->addColumn('person_id', 'integer', ['notnull' => false]);
        $conversationPersonSchema->addIndex(['conversation_id'], 'IDX_FMCP_CONVERSATION');
        $conversationPersonSchema->addIndex(['person_id'], 'IDX_FMCP_PERSON');
        $conversationPersonSchema->setPrimaryKey(['id']);

        $conversationPersonTagSchema = $schema->createTable($this->conversationPersonTag);
        $conversationPersonTagSchema->addColumn('conversation_person_id', 'integer');
        $conversationPersonTagSchema->addColumn('tag_id', 'integer');
        $conversationPersonTagSchema->addIndex(['conversation_person_id'], 'IDX_FMCPT_CONVERSATION');
        $conversationPersonTagSchema->addIndex(['tag_id'], 'IDX_FMCPT_TAg');
        $conversationPersonTagSchema->setPrimaryKey(['conversation_person_id', 'tag_id']);

        $messageSchema = $schema->createTable($this->message);
        $messageSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $messageSchema->addColumn('conversation_id', 'integer', ['notnull' => false]);
        $messageSchema->addColumn('sender_id', 'integer', ['notnull' => false]);
        $messageSchema->addColumn('body', 'text');
        $messageSchema->addColumn('date', 'datetime');
        $messageSchema->addIndex(['conversation_id'], 'IDX_FMM_CONVERSATION');
        $messageSchema->addIndex(['sender_id'], 'IDX_FMM_SENDER');
        $messageSchema->setPrimaryKey(['id']);

        $messagePersonSchema = $schema->createTable($this->messagePerson);
        $messagePersonSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $messagePersonSchema->addColumn('message_id', 'integer', ['notnull' => false]);
        $messagePersonSchema->addColumn('person_id', 'integer', ['notnull' => false]);
        $messagePersonSchema->addColumn('read_date', 'datetime', ['notnull' => false]);
        $messagePersonSchema->addIndex(['message_id'], 'IDX_FMMP_MESSAGE');
        $messagePersonSchema->addIndex(['person_id'], 'IDX_FMMP_PERSON');
        $messagePersonSchema->setPrimaryKey(['id']);

        $messageTagSchema = $schema->createTable($this->messageTag);
        $messageTagSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $messageTagSchema->addColumn('name', 'string');
        $messageTagSchema->setPrimaryKey(['id']);

        // Add constraints
        $conversationPersonSchema->addForeignKeyConstraint($conversationSchema, ['conversation_id'], ['id'], [], 'FK_8053298C9AC0396');
        $conversationPersonSchema->addForeignKeyConstraint($userSchemaName, ['person_id'], ['id'], [], 'FK_8053298C217BBB47');

        $conversationPersonTagSchema->addForeignKeyConstraint($conversationPersonSchema, ['conversation_person_id'], ['id'], ['onDelete' => 'cascade'], 'FK_CECC51B83C2CE59C');
        $conversationPersonTagSchema->addForeignKeyConstraint($messageTagSchema, ['tag_id'], ['id'], ['onDelete' => 'cascade'], 'FK_CECC51B8BAD26311');

        $messageSchema->addForeignKeyConstraint($conversationSchema, ['conversation_id'], ['id'], [], 'FK_1D05ED139AC0396');
        $messageSchema->addForeignKeyConstraint($userSchemaName, ['sender_id'], ['id'], [], 'FK_1D05ED13F624B39D');

        $messagePersonSchema->addForeignKeyConstraint($messageSchema, ['message_id'], ['id'], [], 'FK_8EEA1531537A1329');
        $messagePersonSchema->addForeignKeyConstraint($userSchemaName, ['person_id'], ['id'], [], 'FK_8EEA1531217BBB47');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // Load tables
        $conversationSchema = $schema->getTable($this->conversation);
        $conversationPersonSchema = $schema->getTable($this->conversationPerson);
        $conversationPersonTagSchema = $schema->getTable($this->conversationPersonTag);
        $messageSchema = $schema->getTable($this->message);
        $messagePersonSchema = $schema->getTable($this->messagePerson);
        $messageTagSchema = $schema->getTable($this->messageTag);

        // Remove table constraints
        $conversationPersonSchema->removeForeignKey('FK_8053298C9AC0396');
        $conversationPersonSchema->removeForeignKey('FK_8053298C217BBB47');

        $conversationPersonTagSchema->removeForeignKey('FK_CECC51B83C2CE59C');
        $conversationPersonTagSchema->removeForeignKey('FK_CECC51B8BAD26311');

        $messageSchema->removeForeignKey('FK_1D05ED139AC0396');
        $messageSchema->removeForeignKey('FK_1D05ED13F624B39D');

        $messagePersonSchema->removeForeignKey('FK_8EEA1531537A1329');
        $messagePersonSchema->removeForeignKey('FK_8EEA1531217BBB47');

        // Drop Tables
        $schema->dropTable($this->conversation);
        $schema->dropTable($this->conversationPerson);
        $schema->dropTable($this->conversationPersonTag);
        $schema->dropTable($this->message);
        $schema->dropTable($this->messagePerson);
        $schema->dropTable($this->messageTag);
    }
}
