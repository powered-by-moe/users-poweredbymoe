<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Class Version20160410003813
 *
 * Create FOSUser table
 *
 * @package Application\Migrations
 * @author Oguzhan Uysal <development@oguzhanuysal.eu>
 */
class Version20160410003813 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $userTable = $schema->createTable('fos_user');
        $userTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $userTable->addColumn('username', 'string');
        $userTable->addColumn('username_canonical', 'string');
        $userTable->addColumn('email', 'string');
        $userTable->addColumn('email_canonical', 'string');
        $userTable->addColumn('enabled', 'boolean');
        $userTable->addColumn('salt', 'string');
        $userTable->addColumn('password', 'string');
        $userTable->addColumn('last_login', 'datetime', ['notnull' => false]);
        $userTable->addColumn('locked', 'boolean');
        $userTable->addColumn('expired', 'boolean');
        $userTable->addColumn('expires_at', 'datetime', ['notnull' => false]);
        $userTable->addColumn('confirmation_token', 'string', ['notnull' => false]);
        $userTable->addColumn('password_requested_at', 'datetime', ['notnull' => false]);
        $userTable->addColumn('roles', 'array');
        $userTable->addColumn('credentials_expired', 'boolean');
        $userTable->addColumn('credentials_expire_at', 'datetime', ['notnull' => false]);
        $userTable->addUniqueIndex(['username_canonical'], 'UNIQ_957A647992FC23A8');
        $userTable->addUniqueIndex(['email_canonical'], 'UNIQ_957A6479A0D96FBF');
        $userTable->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('fos_user');
    }
}
