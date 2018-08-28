<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function download()
    {
        if (Auth::check() && Auth::user()->is_superuser)
        {
            try
            {
                Artisan::call('backup:run', ['--only-db' => true, '--disable-notifications' => true]);

                $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
                $file = $disk->files(config('backup.backup.name'))[0];
                $fs = $disk->getDriver();
                $stream = $fs->readStream($file);
                $mimeType = $fs->getMimetype($file);
                $size = $fs->getSize($file);
                $basename = basename($file);
                $disk->delete($file);
                return Response::stream(function () use ($stream, $mimeType, $size, $basename) {
                    fpassthru($stream);
                }, 200, [
                    "Content-Type" => $mimeType,
                    "Content-Length" => $size,
                    "Content-disposition" => "attachment; filename=\"" . $basename . "\"",
                ]);
            }
            catch (\Exception $e)
            {
                abort(404, 'Can\'t make database backup.');
            }
        }

        return redirect()->back();
    }
}
