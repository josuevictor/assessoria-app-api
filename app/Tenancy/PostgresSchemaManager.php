<?php

namespace App\Tenancy;

use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Database\DatabaseManager;

class PostgresSchemaManager extends DatabaseManager
{
    public function createDatabase(string $name)
    {
        DB::statement("CREATE SCHEMA IF NOT EXISTS \"$name\";");
    }

    public function deleteDatabase(string $name)
    {
        DB::statement("DROP SCHEMA IF EXISTS \"$name\" CASCADE;");
    }

    public function setConnection(string $name)
    {
        config(['database.connections.tenant.schema' => $name]);
        DB::purge('tenant');
        DB::reconnect('tenant');
    }
}
