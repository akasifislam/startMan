<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuBilderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.menus.index');
        $menu = Menu::findOrFail($id);
        return view('backend.menus.builder', compact('menu'));
    }

    public function order(Request $request, $id)
    {
        Gate::authorize('app.menus.index');
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $item) {
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order' => $index + 1,
                'parent_id' => $parentId
            ]);

            if (isset($item->children)) {
                $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }

    public function itemCreate($id)
    {
        Gate::authorize('app.menus.create');
        $menu = Menu::findOrFail($id);
        return view('backend.menus.item.from', compact('menu'));
    }

    public function itemStore(Request $request, $id)
    {
        Gate::authorize('app.menus.create');
        $this->validate($request, [
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);

        $menu->menuItems()->create([
            'type' => $request->get('type'),
            'divider_title' => $request->get('divider_title'),
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);
        notify()->success('menu item created', 'success');
        return redirect()->route('app.menus.builder', $menu->id);
    }
    public function itemEdit($id, $itemId)
    {
        Gate::authorize('app.menus.edit');
        $menu = Menu::findOrFail($id);
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId);
        return view('backend.menus.item.from', compact('menu', 'menuItem'));
    }

    public function itemUpdate(Request $request, $id, $itemId)
    {
        Gate::authorize('app.menus.edit');
        $this->validate($request, [
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId)->update([
            'type' => $request->get('type'),
            'divider_title' => $request->get('divider_title'),
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'target' => $request->get('target'),
            'icon_class' => $request->get('icon_class'),
        ]);
        notify()->success('menu item updated', 'updated');
        return redirect()->route('app.menus.builder', $menu->id);
    }

    public function itemDestroy($id, $itemId)
    {
        Gate::authorize('app.menus.destroy');
        Menu::findOrFail($id)
            ->menuItems()
            ->findOrFail($itemId)
            ->delete();
        notify()->warning('Deleted', 'success');
        return back();
        // return back();
    }
}
