<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Disease;
use App\Models\pdfrecords;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function view($id,$pdf_path)
    {
        //$pdfNew = substr($pdf_path, 8);
        $pdfNewPath = 'uploads/'.$pdf_path;
        //dd($pdf_path,$id);
        //dd($pdfNewPath);
        // Find the PDF record by ID (assuming 'pdfrecords' model)
        $pdfRecord = pdfrecords::where('id', $id)
        ->where(function ($query) use ($pdfNewPath) {
            $query->where('pdf_path', $pdfNewPath)
                  ->orWhere('pdf_path2', $pdfNewPath)
                  ->orWhere('pdf_path3', $pdfNewPath);
        })
        ->first();
        //dd($pdfRecord);
    
        // Check if the record exists
        if (!$pdfRecord) {
            //dd('db no');
            abort(404); // Or handle the case when the record is not found
        }
    
        // Build the full path to the PDF file
        $pdfPath = storage_path("app/public/{$pdfNewPath}");
    
        // Check if the file exists
        if (!file_exists($pdfPath)) {
           // dd('file no');
            abort(404); // Or handle the case when the file is not found
        }
    
        // Stream the PDF to the browser
        return response()->stream(
            function () use ($pdfPath) {
                readfile($pdfPath);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($pdfPath) . '"',
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
