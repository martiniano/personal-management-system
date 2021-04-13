<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Controller\Core\Migrations;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201018124944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->connection->executeQuery(Migrations::buildSqlExecutedIfConstraint(
            Migrations::CONSTRAINT_TYPE_INDEX,
            'file_path_index',
            'CREATE INDEX file_path_index ON files_tags (full_file_path)',
            Migrations::CHECK_TYPE_IF_NOT_EXIST
        ));

        $this->connection->executeQuery(Migrations::buildSqlExecutedIfConstraint(
            Migrations::CONSTRAINT_TYPE_INDEX,
            'locked_resource_index',
            'CREATE INDEX locked_resource_index ON locked_resource(type, record, target)',
            Migrations::CHECK_TYPE_IF_NOT_EXIST
        ));

        $this->connection->executeQuery(Migrations::buildSqlExecutedIfConstraint(
            Migrations::CONSTRAINT_TYPE_INDEX,
            'locked_resource_index',
            'CREATE INDEX my_note_category_index ON my_note_category(id)',
            Migrations::CHECK_TYPE_IF_NOT_EXIST
        ));

        $this->addSql(Migrations::getSuccessInformationSql());
    }

    public function down(Schema $schema) : void
    {
        // no way back
    }
}
