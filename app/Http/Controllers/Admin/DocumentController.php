<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.document-list', ['documents' => Document::orderBy('order', 'asc')->get(), 'document' => false]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        $file = $request->file('file');
        $tempPath = $file->path();
        $dbPath = 'public_files/documents/' . time() . $file->hashName();
        $documentPath = base_path($dbPath);
        $documentPath = str_replace('/project/', '/web/', $documentPath);
        if (!move_uploaded_file($tempPath, $documentPath)) {
            throw new FileUploadException('Nahrávanie dokumentu zlyhalo');
        }
        Document::create([
            'name' => $request->name,
            'path' => $dbPath
        ]);
        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('admin.document-list', ['documents' => Document::orderBy('order', 'asc')->get(), 'document' => $document]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $inputs = $request->input();
        if ($request->has('file')) {
            $file = $request->file('file');
            $tempPath = $file->path();
            $dbPath = 'public_files/documents/' . time() . $file->hashName();
            $documentPath = base_path($dbPath);
            $documentPath = str_replace('/project/', '/web/', $documentPath);
            if (!move_uploaded_file($tempPath, $documentPath)) {
                throw new FileUploadException('Nahrávanie dokumentu zlyhalo');
            }
            $inputs = array_merge($inputs, ['path' => $dbPath]);
            $oldDocumentPath = str_replace('/project/', '/web/', base_path($document->path));
            if (file_exists($oldDocumentPath)) {
                unlink($oldDocumentPath);
            }
        }
        $document->fill($inputs)->save();
        return redirect()->route('documents.index');
    }

    public function reorder(Request $request)
    {
        $reorder = $request->reorder;
        foreach ($reorder as $id => $order) {
            $document = Document::find($id);
            if ($document) {
                $document->order = $order;
                $document->save();
            }
        }
        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index');
    }
}
