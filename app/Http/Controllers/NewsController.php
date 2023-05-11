<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Notice;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if($request->filter){
            $news = Notice::where('user_id', '=', auth()->user()->id)->where('title', 'LIKE', "%$request->filter%")->get();
        }else{
            $news = Notice::where('user_id', '=', auth()->user()->id)->get();
        }

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(NewsRequest $request)
    {
        $data = $request->only(['title','description','content']);
        $data['user_id'] = auth()->user()->id;
        $news = Notice::create($data);

        return redirect()->route('news.index')->with('status_success', __('Successfully created'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $new = Notice::find($id);

        return view('news.edit', ['new' => $new]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsUpdateRequest $request, string $id)
    {
        $new = Notice::find($id);
        $new->update($request->only(['title','description','content']));

        return redirect()->route('news.index')->with('status_success', __('Successfully updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Notice::find($id)->delete();

        return redirect()->route('news.index')->with('status_danger', __('Deleted New.'));
    }
}
