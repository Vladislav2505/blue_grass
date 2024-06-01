<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dbHost = config('database.connections.mysql.host');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $backupPath = storage_path('app/backups/'.'backup.sql');

        $command = "mysqldump --user={$dbUser} --password={$dbPass} --host={$dbHost} {$dbName} > {$backupPath}";

        $result = null;
        $output = [];
        exec($command, $output, $result);

        if ($result === 0) {
            $this->info('Database backup was successful.');

            return 0;
        }

        $this->error('Database backup failed.');

        return 1;
    }
}
