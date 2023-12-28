<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tenant;
use App\Models\Menu;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function home(){
        return view('user.home');
    }

    public function createOrder(Request $request){ //kalo ini gunanya buat ngebuat orderan buat usernya
        $request->validate([
            'menu_id' => 'required|string|max:255',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'food_name' => $menu->name
        ]);

        if($order) {
            return redirect()->route('user.order.status')->with('success', 'Order berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal');
        }
    }    

    public function viewOrderStatus(){ //kalo ini buat ngeliat status ordernya
        $user = auth()->user();
        $orders = $user->orders()->with('menu')->latest()->get();
        return view('user.order_status', compact('orders'));
    }

    public function confirmReceived($orderId) //kalo ini buat konfirmasi orderannya jadi kalo statusnya udah arrived gitu bisa di konfirmasi sama usernya
    {
        $order = Order::where('id', $orderId)
                      ->where('user_id', auth()->user()->id)
                      ->first();

        if ($order && $order->status == 'Food Arrived') { //ini diangejelasin kalo attribute status di table order udah jadi food arrived dia ngedelete orderan itu dari table
            $order->delete();
            return redirect()->route('user.order.status')->with('success', 'Order confirmed and deleted successfully.');
        }

        return redirect()->route('user.order.status')->with('error', 'Unable to confirm order.');
    }

    public function showTenants(){ //kalo ini buat nunjukkin tenantnya apa aja di user
        $tenants = Tenant::all();
        return view('user.choose_tenants', compact('tenants'));
    }

    public function showTenantMenu($tenantId){ //kalo ini dia buat nunjukkin menu tenantnya
        $menuItems = Menu::where('tenant_id', $tenantId)->get(); //nah ini dia ngambil menu-menu yang ada asosiasi sama tenantnya
        $tenant = Tenant::findOrFail($tenantId); //nah ini ngambil details tenant
        return view('user.tenant_menu', compact('menuItems', 'tenant'));

    }

    public function createOrUpdateMenu(Request $request, $menuId = null){ //nah disini dia buat ngeupdate menu dari table menus
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($menuId) {
            $menu = Menu::findOrFail($menuId);
        } else {
            $menu = new Menu();
        }

        //Ini buat setup menu nya
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        //Ini tuh logic buat file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/menus'), $imageName);
            $menu->image = 'images/menus/'.$imageName;
        }

        $menu->save();

        return redirect()->back()->with('success', 'Menu item saved successfully.');
    }
}
