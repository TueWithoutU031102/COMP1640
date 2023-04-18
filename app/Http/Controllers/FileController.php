<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadAllFiles($submissionId)
    {
        // Get all PDF and DOC files from a directory (change the path to your directory)
        $files = Storage::disk('public')->files('ideas');

        if (count($files) == 0) {
            abort(404);
        }

        $zipName = 'files.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/public/'.$zipName), ZipArchive::CREATE);

        foreach ($files as $file) {
            // Only add PDF and DOC files to the ZIP archive
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($ext, ['pdf', 'doc', 'docx'])) {
                $filename = basename($file);
                $zip->addFile(Storage::disk('public')->path($file), $filename);
            }
        }

        $zip->close();

        return response()->download(storage_path('app/public/'.$zipName))->deleteFileAfterSend();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\File\StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request, int $ideaId)
    {
        $pdfs = $request->file('files');
        if (!$pdfs) return false;
        foreach ($pdfs as $pdf) {
            $path = $this->saveFileIdeas($pdf);
            $file = new File(
                [
                    "path" => $path,
                    "filename" => $pdf->getClientOriginalName(),
                    "idea_id" => $ideaId
                ]);
            $file->save();
        }
        return true;
    }

    public function saveFileIdeas(UploadedFile $file): string
    {
        $name = uniqid("idea_") . "." . $file->getClientOriginalExtension();
        move_uploaded_file($file->getPathname(), public_path('ideas/' . $name));
        return "ideas/" . $name;
    }
}
