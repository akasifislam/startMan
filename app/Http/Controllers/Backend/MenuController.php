<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.menus.index');
        $menus = Menu::latest('id')->get();
        return view('backend.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.menus.create');
        return view('backend.menus.from');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:menus',
            'description' => 'nullable|string',
        ]);

        Menu::create([
            'name' => Str::slug($request->get('name')),
            'description' => $request->get('description'),
            'deletable' => true,
        ]);
        notify()->success('Menu Created', 'success');
        return redirect()->route('app.menus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(menu $menu)
    {
        Gate::authorize('app.menus.edit');
        return view('backend.menus.from', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        Gate::authorize('app.menus.create');
        $this->validate($request, [
            'name' => 'required|string|unique:menus,name,' . $menu->id,
            'description' => 'nullable|string',
        ]);

        $menu->update([
            'name' => Str::slug($request->get('name')),
            'description' => $request->get('description'),
            'deletable' => true,
        ]);
        notify()->success('Menu Updated', 'success');
        return redirect()->route('app.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu $menu)
    {
        Gate::authorize('app.menus.destroy');
        if ($menu->deletable == true) {
            $menu->delete();
            notify()->success('Menu Deleted', 'success');
        } else {
            notify()->error('sorry', 'error');
        }
        return back();
    }
}
