<?php

namespace App\Livewire;

use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use TomatoPHP\FilamentBrowser\Events\BrowserFileSaved;

class Browser extends Component implements HasMingles
{
    use InteractsWithMingles;

    public function component(): string
    {
        return 'resources/js/Browser.js';
    }

    public function load($folder_path, $folder_name, $getType='folder', $file_path=null, $file_name=null,$path=null, $content=null)
    {
        if ($folder_path) {
            $root = $folder_path;
            $name = $folder_name;
            $type = $getType;
        } else if ($file_path) {
            $name = $file_name;
            $setFilePath = $file_path;
            $root = str_replace(DIRECTORY_SEPARATOR . $name, '', $file_path);
        } else {
            $startPath = config('filament-browser.start_path');
            $root = $startPath;
            $name = $startPath;
            $type = "home";
        }



        if ($file_path) {
            $getFile = File::get($setFilePath);

            $folders =  File::directories($root);
            $files =  File::files($root);
            $foldersArray = [];
            $filesArray = [];

            foreach ($folders as $folder) {
                array_push($foldersArray, [
                    "path" => $folder,
                    "name" => str_replace($root . DIRECTORY_SEPARATOR, '', $folder),
                ]);
            }

            foreach ($files as $file) {
                array_push($filesArray, [
                    "path" => $file->getRealPath(),
                    "name" => str_replace($root . DIRECTORY_SEPARATOR, '', $file),
                ]);
            }

            $exploadName = explode(DIRECTORY_SEPARATOR, $root);
            $count = count($exploadName);
            $setName = $exploadName[$count - 1];

            $ex = File::extension($setFilePath);

            if ($ex === 'webp' || $ex === 'jpg' || $ex === 'png' || $ex === 'svg' || $ex === 'jpeg' || $ex === 'ico' ||  $ex === 'gif' || $ex === 'tif') {
                $imagBase64 = base64_encode($getFile);
                $getFile = $imagBase64;
            }

            return [
                "folders" => $foldersArray,
                "files" => $filesArray,
                "back_path" => $root,
                "back_name" => $setName,
                "current_path" => $root,
                "file" => $getFile,
                "ex" => $ex,
                "path" => $setFilePath
            ];
        } elseif ($content) {
            $filename = $path;
            $checkIfFileEx = File::exists($filename);
            if ($checkIfFileEx) {
                File::put($filename, $content);

                BrowserFileSaved::dispatch($filename);

                return [
                    "success" => true,
                    "message" => __('File saved successfully!')
                ];
            }
        } else {
            $folders =  File::directories($root);
            $files =  File::files($root);
            $foldersArray = [];
            $filesArray = [];

            foreach ($folders as $folder) {
                array_push($foldersArray, [
                    "path" => $folder,
                    "name" => str_replace($root . DIRECTORY_SEPARATOR, '', $folder),
                ]);
            }

            foreach ($files as $file) {
                $ex = File::extension($file);
                array_push($filesArray, [
                    "path" => $file->getRealPath(),
                    "name" => str_replace($root . DIRECTORY_SEPARATOR, '', $file),
                    "ex" => $ex
                ]);
            }

            if ($root == base_path()) {
                array_push($filesArray, [
                    "path" => base_path('.env'),
                    "name" => ".env",
                ]);
            }

            $foldersArray = array_filter($foldersArray, function ($folder) {
                $path = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $folder['path']);
                return !in_array($path, config('filament-browser.hidden_folders'));
            });

            $filesArray = array_filter($filesArray, function ($file) {
                $path = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file['path']);
                return !in_array($path, config('filament-browser.hidden_files'));
            });

            $exploadName = explode(DIRECTORY_SEPARATOR, $root);
            $count = count($exploadName);
            $setName = $exploadName[$count - 2];

            return [
                "folders" => $foldersArray,
                "files" => $filesArray,
                "back_path" => str_replace(DIRECTORY_SEPARATOR . $name, '', $root),
                "back_name" => $setName,
                "current_path" => $root,
            ];
        }
    }

    public function mingleData()
    {
        $startPath = config('filament-browser.start_path');
        $folders =  File::directories($startPath);
        $files =  File::files($startPath);
        $foldersArray = [];
        $filesArray = [];
        $root = $startPath;
        $name = $startPath;

        foreach ($folders as $folder) {
            array_push($foldersArray, [
                "path" => $folder,
                "name" => str_replace($startPath . DIRECTORY_SEPARATOR, '', $folder),
            ]);
        }

        foreach ($files as $file) {
            array_push($filesArray, [
                "path" => $file->getRealPath(),
                "name" => str_replace($startPath . DIRECTORY_SEPARATOR, '', $file),
            ]);
        }

        if ($root == base_path()) {
            array_push($filesArray, [
                "path" => base_path('.env'),
                "name" => ".env",
            ]);
        }

        $foldersArray = array_filter($foldersArray, function ($folder) {
            $path = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $folder['path']);
            return !in_array($path, config('filament-browser.hidden_folders'));
        });

        $filesArray = array_filter($filesArray, function ($file) {
            $path = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file['path']);
            return !in_array($path, config('filament-browser.hidden_files'));
        });

        $exploadName = explode(DIRECTORY_SEPARATOR, $root);
        $count = count($exploadName);
        $setName = $exploadName[$count - 1];

        return [
            "url" => url('admin/browser'),
            "folders" => $foldersArray,
            "files" => $filesArray,
            "back_path" => str_replace(DIRECTORY_SEPARATOR . $name, '', $root),
            "back_name" => $setName,
            "current_path" => $root,
            "view" => view('browser')->render()
        ];
    }
}
