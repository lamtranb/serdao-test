<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration: I think it's a MUST when doing any development (even if we don't use framework).
 * Example if we use a standalone source code, we can install composer require doctrine/migrations.
 * Because:
 * - Versioning your database schema: it allows us to control any database changes.
 */
final class Version20240213155556 extends AbstractMigration
{
    /**
     * For installing.
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        // Should not write RAW SQL queries here. Using Schema instead.
        // Create the new user table.
        if (!$schema->hasTable('user')) {
            $table = $schema->createTable('user');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('firstname', 'string', ['length' => 180, 'notnull' => true]);
            $table->addColumn('lastname', 'string', ['length' => 180, 'notnull' => true]);
            $table->addColumn('address', 'string', ['length' => 255, 'notnull' => true]);
            $table->setPrimaryKey(['id']);
        }
    }

    /**
     * For rollback.
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // Drop the user table
        if ($schema->hasTable('user')) {
            $schema->dropTable('user');
        }
    }
}
