<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160410153229 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $accessTokenSchema = $schema->createTable('oauth2_access_tokens');
        $accessTokenSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $accessTokenSchema->addColumn('client_id', 'integer');
        $accessTokenSchema->addColumn('user_id', 'integer', ['notnull' => false]);
        $accessTokenSchema->addColumn('token', 'string');
        $accessTokenSchema->addColumn('expires_at', 'integer', ['notnull' => false]);
        $accessTokenSchema->addColumn('scope', 'string', ['notnull' => false]);
        $accessTokenSchema->addUniqueIndex(['token'], 'UNIQ_D247A21B5F37A13B');
        $accessTokenSchema->addIndex(['client_id'], 'IDX_D247A21B19EB6921');
        $accessTokenSchema->addIndex(['user_id'], 'IDX_D247A21BA76ED395');
        $accessTokenSchema->setPrimaryKey(['id']);

        $authCodeSchema = $schema->createTable('oauth2_auth_codes');
        $authCodeSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $authCodeSchema->addColumn('client_id', 'integer');
        $authCodeSchema->addColumn('user_id', 'integer', ['notnull' => false]);
        $authCodeSchema->addColumn('token', 'string');
        $authCodeSchema->addColumn('redirect_uri', 'text');
        $authCodeSchema->addColumn('expires_at', 'integer', ['notnull' => false]);
        $authCodeSchema->addColumn('scope', 'string', ['notnull' => false]);
        $authCodeSchema->addUniqueIndex(['token'], 'UNIQ_A018A10D5F37A13B');
        $authCodeSchema->addIndex(['client_id'], 'IDX_A018A10D19EB6921');
        $authCodeSchema->addIndex(['user_id'], 'IDX_A018A10DA76ED395');
        $authCodeSchema->setPrimaryKey(['id']);

        $clientSchema = $schema->createTable('oauth2_clients');
        $clientSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $clientSchema->addColumn('random_id', 'string');
        $clientSchema->addColumn('redirect_uris', 'array', ['comment' => '(DC2Type:array)']);
        $clientSchema->addColumn('secret', 'string');
        $clientSchema->addColumn('allowed_grant_types', 'array', ['comment' => '(DC2Type:array)']);
        $clientSchema->setPrimaryKey(['id']);

        $refreshTokenSchema = $schema->createTable('oauth2_refresh_tokens');
        $refreshTokenSchema->addColumn('id', 'integer', ['autoincrement' => true]);
        $refreshTokenSchema->addColumn('client_id', 'integer');
        $refreshTokenSchema->addColumn('user_id', 'integer', ['notnull' => false]);
        $refreshTokenSchema->addColumn('token', 'string');
        $refreshTokenSchema->addColumn('expires_at', 'integer', ['notnull' => false]);
        $refreshTokenSchema->addColumn('scope', 'string', ['notnull' => false]);
        $refreshTokenSchema->addUniqueIndex(['token'], 'UNIQ_D394478C5F37A13B');
        $refreshTokenSchema->addIndex(['client_id'], 'IDX_D394478C19EB6921');
        $refreshTokenSchema->addIndex(['user_id'], 'IDX_D394478CA76ED395');
        $refreshTokenSchema->setPrimaryKey(['id']);

        $accessTokenSchema->addForeignKeyConstraint($clientSchema, ['client_id'], ['id'], [], 'FK_D247A21B19EB6921');
        $accessTokenSchema->addForeignKeyConstraint('fos_user', ['user_id'], ['id'], [], 'FK_D247A21BA76ED395');

        $authCodeSchema->addForeignKeyConstraint($clientSchema, ['client_id'], ['id'], [], 'FK_A018A10D19EB6921');
        $authCodeSchema->addForeignKeyConstraint('fos_user', ['user_id'], ['id'], [], 'FK_A018A10DA76ED395');

        $refreshTokenSchema->addForeignKeyConstraint($clientSchema, ['client_id'], ['id'], [], 'FK_D394478C19EB6921');
        $refreshTokenSchema->addForeignKeyConstraint('fos_user', ['user_id'], ['id'], [], 'FK_D394478CA76ED395');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $accessTokenSchemaName = 'oauth2_access_tokens';
        $accessTokenSchema = $schema->getTable($accessTokenSchemaName);
        $accessTokenSchema->removeForeignKey('FK_D247A21B19EB6921');
        $accessTokenSchema->removeForeignKey('FK_D247A21BA76ED395');
        $schema->dropTable($accessTokenSchemaName);

        $authCodeSchemaName = 'oauth2_auth_codes';
        $authCodeSchema = $schema->getTable($authCodeSchemaName);
        $authCodeSchema->removeForeignKey('FK_A018A10D19EB6921');
        $authCodeSchema->removeForeignKey('FK_A018A10DA76ED395');
        $schema->dropTable($authCodeSchema);

        $refreshTokenSchemaName = 'oauth2_refresh_tokens';
        $refreshTokenSchema = $schema->getTable($refreshTokenSchemaName);
        $refreshTokenSchema->removeForeignKey('FK_D394478C19EB6921');
        $refreshTokenSchema->removeForeignKey('FK_D394478CA76ED395');
        $schema->dropTable($refreshTokenSchemaName);

        $schema->dropTable('oauth2_clients');
    }
}
