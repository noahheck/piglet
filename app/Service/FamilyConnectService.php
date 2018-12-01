<?php

namespace App\Service;

use App\Family;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FamilyConnectService
{
    public function connectToFamily($family)
    {
        if (!($family instanceof Family)) {
            $family = Family::find($family);
        }

        // Erase the family connection, thus making Laravel get the default values all over again.
        DB::purge('family');

        // Make sure to use the database name we want to establish a connection.
        Config::set('database.connections.family.database', $family->dbFilePath());

        // Rearrange the connection data
        DB::reconnect('family');

        // Ping the database. This will throw an exception in case the database does not exists.
        Schema::connection('family')->getConnection()->reconnect();

        // Enable foreign key support for sqlite
        Schema::connection('family')->getConnection()->raw('PRAGMA foreign_keys=1');

        return $this;
    }

    /**
     * Migrates the currently connected family database to the latest version
     */
    public function migrate()
    {
        Artisan::call('migrate', [
            '--database' => 'family',
            '--path'     => 'database/migrations_family',
            '--force'    => true,
        ]);

        return $this;
    }

    /**
     * Rolls back the latest database change for the currently connected family database
     */
    public function rollback()
    {
        Artisan::call('migrate:rollback', [
            '--database' => 'family',
            '--path'     => 'database/migrations_family',
            '--force'    => true,
        ]);
    }
}
