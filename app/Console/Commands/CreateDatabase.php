<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CreateDatabase extends Command
{
    protected $signature = 'db:create {name}';
    protected $description = 'Create a new database';

    public function handle()
    {
        $database = $this->argument('name');

        // Temporarily connect without database
        Config::set('database.connections.mysql.database', null);
        DB::purge('mysql');

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $this->info("Database '$database' created successfully.");
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
