<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use ZipArchive;
use Hash;
use Auth;
use Session;
use Storage;
use Artisan;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
  public function index()
  {
    $files = Storage::files(config('app.name'));
    $backups = [];

    foreach ($files as $file) {
      if (substr($file, -4) == '.zip' && Storage::disk('local')->exists($file)) {
        $size = Storage::size($file);
        $last_modified = Carbon::createFromTimestamp(Storage::lastModified($file));
        $backups[] = [
          // 'path' => $file,
          'name' => str_replace(config('app.name') . '/', '', $file),
          'size' => $this->bytesToHuman($size),
          'last_modified' => $last_modified->toFormattedDateString(),
          'age' => str_replace(' ago', '', $last_modified->diffForHumans())
        ];
      }
    }

    $backups = array_reverse($backups);

    return view('manage.database.index', compact('backups'));
  }

  public function backup()
  {
    Artisan::call('backup:run', ['--only-db' => true]);
    Session::flash('success', 'Backup file has successfully created.');

    return redirect()->back();
  }

  public function restore(Request $request)
  {
    // Check for password
    if (Hash::check($request->password, Auth::user()->password))
    {
      // Open Zip File
      $zip = new ZipArchive;
      $res = $zip->open(storage_path("app/Laravel/$request->filename"));

      if ($res === TRUE) {
        // Extract Zip File
        $zip->extractTo(storage_path('app'));
        $zip->close();

        // Restore Database Command
        $username = env('DB_USERNAME');
        // $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $database = env('DB_DATABASE');
        $sql_file = storage_path('app\db-dumps\mysql-marketplace.sql');

        $command = "mysql -u $username -h $host $database < $sql_file";
        // If password required
        // $command = "mysql -u $username -p $password -h $host $database < $sql_file";

        // Execute command
        exec($command, $output, $return);

        if (!$return) {
          Session::flash('success', 'Backup file has successfully restored.');
        } else {
          Session::flash('error', 'Backup file has failed to be restored.');
        }

        if (Storage::disk('local')->exists('db-dumps')) {
          Storage::deleteDirectory('db-dumps');
        }
      }
    } else {
      Session::flash('wrongPassword', 'Password not match.');
    }

    return redirect()->back();
  }

  public function download($filename)
  {
    $file = config('app.name') . '/' . $filename;

    if (Storage::disk('local')->exists($file)) {
      return Storage::download($file);
    } else {
      return redirect()->back()->with('error', 'File not found on the server.');
    }
  }

  public function delete($filename)
  {
    Storage::delete(config('app.name') . '/' . $filename);
    Session::flash('success', 'Backup file has successfully deleted.');

    return redirect()->back();
  }

  public function bytesToHuman($bytes)
  {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

    for ($i = 0; $bytes > 1024; $i++) {
      $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
  }
}
