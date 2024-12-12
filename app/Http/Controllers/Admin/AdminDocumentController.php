<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminDocumentController extends Controller
{
    public function create(Product $product)
    {
        $document_types = DocumentType::all();
        return view('admin.documents.create', compact('product', 'document_types'));
    }

    public function make_main(Product $product, Document $document)
    {
        // $product->documents->update([
        //     'main' => false
        // ]);
        Document::where('product_id', $product->id)->update([
            'main' => false
        ]);
        $document->main = true;
        $document->save();
        return redirect()->route('admin.products.show', $product)->with('success', 'Document was mained.');
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'product_id' => 'required',
            'document_type_id' => 'required',
            'title' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:jpg,png,jpeg,gif,svg',
            'link' => 'nullable|url|max:255',
        ]);

        $document = new Document([
            'title' => $request->title,
            'link' => $request->url,
            'product_id' => $request->product_id,
        ]);

        $filepath = '';
        if($request->hasFile('file')) {
            $filepath = Post::uploadImage($request->file('file'));
        }
        $document->file_path = $filepath;

        $document->document_type_id = $request->document_type_id;
        $product->documents()->save($document);

        return redirect()->route('admin.products.show', $product)->with('success', 'Document added successfully.');
    }

    public function destroy(Product $product, Document $document)
    {

        if (!empty($document->file_path) && file_exists($document->getImageSystemPath())){
            unlink($document->getImageSystemPath());
        }

        $document->delete();

        return redirect()->route('admin.products.show', $document->product)->with('success', 'Document deleted successfully.');
    }
}
