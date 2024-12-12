<?php

namespace App\Http\Controllers;

use App\Models\RefBook;
use App\Models\RefItem;
use Illuminate\Http\Request;

class RefBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = RefBook::orderBy('order', 'DESC')->paginate(10);

        if ($request->has('trashed')) {
            $list = RefBook::onlyTrashed()->paginate(10);
        } else {
            $list =RefBook::orderBy('order', 'DESC')->paginate(10);
        }

        return view('ref_books.list', [
            'list' => $list
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ref_books.new', [
            'ref_books' => RefBook::orderBy('title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'alias' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9]+$/u|max:255',
        ]);

        if (RefBook::alias($request->alias)){
            session()->flash('success', 'Справочник с таким машинным именем уже существует');
            return redirect()->back();
        }

        $input = $request->all();
        $input['visible'] = (bool)$request->visible;

        if ($input['order'] == null) {
            $input['order'] = 0;
        }

        $options = [];
        foreach ($input['option'] as $option){
            if ($option != null){
                $options[] = $option;
            }
        }
        $options = ['items' => $options];

        RefBook::create([
            'title' => $input['title'],
            'alias' => $input['alias'],
            'description' => $input['description'],
            'parent_id' => $input['parent_id'],
            'visible' => $input['visible'],
            'order' => $input['order'],
            'options' => $options,
        ]);

        session()->flash('success', 'Создан «' . $request->title . '» справочник');

        return redirect('/refbooks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefBook  $refBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $refbook = RefBook::find($id);
        return view('ref_books.show', [
            'book' => $refbook,
            'items' => $refbook->items
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefBook  $refBook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('ref_books.edit', [
            'ref_book' => RefBook::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefBook  $refBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'order' => 'required|integer',
        ]);

        $ref_book = RefBook::find($request->id);
        $ref_book->update($request->all());

        session()->flash('success', 'Справочник обнавлён');
        return redirect('/refbooks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefBook  $refBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RefBook::find($id)->delete();
        session()->flash('success', 'Справочник удалён');
  
        return redirect()->back();
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function restore($id)
    {
        RefBook::withTrashed()->find($id)->restore();
        session()->flash('success', 'Справочник восстановлен');
  
        return redirect()->back();
    }

    public function clear_trash()
    {
        RefBook::onlyTrashed()->forceDelete();
        session()->flash('success', 'Корзина очищена');

        return redirect('/refbooks');
    }



    public function item_new(Request $request)
    {
        return view('ref_books.item_new', [
            'book' => RefBook::find($request->id)
        ]);
    }

    public function item_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'book_id' => 'required',
        ]);

        RefItem::create([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description ? $request->description : " " ,
            'book_id' => $request->book_id,
            'options' => $request->items,
            'parent_id' => $request->parent_id,
            'visible' => (bool)$request->visible,
            'order' => $request->order ? $request->order : 0,
        ]);
        session()->flash('success', 'Сохранено');
        return redirect('/refbooks/'. $request->book_id);
    }

    public function item_show($id)
    {
        dd(RefItem::find($id));
    }

    public function item_edit($id)
    {
        return view('ref_books.item_edit', [
            'ref_item' => RefItem::find($id)
        ]);
    }

    public function item_update(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $ref_item = RefItem::find($request->item_id);
        $ref_item->update([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description ? $request->description : " " ,
            'options' => $request->items,
            'parent_id' => $request->parent_id,
            'visible' => (bool)$request->visible,
            'order' => $request->order ? $request->order : 0,
        ]);

        session()->flash('success', 'Сохранено');
        return redirect('/refitems/'. $request->item_id);
    }

    public function item_destroy($id)
    {
        RefItem::find($id)->delete();
        return redirect()->back();
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function item_restore($id)
    {
        RefItem::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
}
