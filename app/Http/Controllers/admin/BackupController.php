<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Show all backups
     */
    public function index()
    {
        $files = Storage::disk('local')->files('Laravel');

        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'name' => basename($file),
                'size' => number_format(Storage::disk('local')->size($file) / 1024 / 1024, 2) . ' MB',
                'date' => date(
                    'd M Y H:i',
                    Storage::disk('local')->lastModified($file)
                ),
            ];
        }

        return view('admin.system.backup', compact('backups'));
    }

    /**
     * Create backup
     */
    public function runBackup()
    {
        Artisan::call('backup:run');

        return redirect()
            ->route('admin.database-backup')
            ->with('success', 'Backup created successfully.');
    }

    /**
     * Download backup
     */
    public function downloadBackup($file)
    {
        return Storage::disk('local')->download('Laravel/' . $file);
    }

    /**
     * Delete backup
     */
    public function deleteBackup($file)
    {
        Storage::disk('local')->delete('Laravel/' . $file);

        return redirect()
            ->route('admin.database-backup')
            ->with('success', 'Backup deleted successfully.');
    }
}