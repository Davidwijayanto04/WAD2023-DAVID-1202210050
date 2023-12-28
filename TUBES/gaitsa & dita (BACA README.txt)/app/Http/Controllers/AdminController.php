<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Tenant;
use App\Models\Menu;

class AdminController extends Controller
{
    function home(){ //ini mah cuma ngambil data dari User trus dia ngereturn view ke home nya admin
        $users = User::all();
        return view('admin.home', compact('users'));
    }

    function delete($id){ //kalo ini buat ngedelete user sesuai sama idnya gitu
        $users = User::find($id);
        if ($users){
            $users->delete();
            return redirect()->back()->with('success', 'User telah berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Error !!');
    }

    function update(Request $request, $id){ //kalo ini buat ngeupdate user yang udah teregistrasi
        $user = User::find($id);
        if ($user){
            $user->name = $request->name;
            $user->role = $request->role;
            $user->save();
            return redirect()->route('admin.home')->with('success', 'User telah berhasil diupdate');
        }
        return redirect()->route('admin.home')->with('error', 'Gagal');
    }

    function edit($id){ //klo ini buat ngedit usernya
        $user = User::find($id);
        if ($user) {
            return view('admin.edit', compact('user'));
        }
        return redirect()->back()->with('error', 'Gagal');
    }

    function viewOrders(Request $request){ //nah ini buat ngeliat list orderan bagian admin
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    function updateOrderStatus(Request $request, $id){ //kalo ini buat ngeupdate status orderannya yg proses, otw, uda sampai dll.
        $order = Order::find($id);
        if ($order) {   
            $validatedData = $request->validate([
                'status' => 'required|string',
            ]);
    
            $order->status = $validatedData['status'];
            $order->save();

            return redirect()->route('admin.orders')->with('success', 'Order status updated!');
        }
        return redirect()->back()->with('error', 'Failed to update order status.');
    }

    public function showMenuForm(){ //kalo ini cuma buat nunjukkin form buat nambahin menu
        $tenants = Tenant::all();
        return view('admin.menu_form', compact('tenants'));
    }

        public function storeMenu(Request $request){ //ini buat ngevalidate data di table tenants
            $request->validate([
                'tenant_id' => 'required|exists:tenants,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $menu = new Menu($request->only(['tenant_id', 'name', 'description', 'price'])); //ngebuat object menu

            if ($request->hasFile('image')) { //nah ini buat ngehandle inputan imagenya jadi kalo imagenya dimasukin baru bisa d lanjutin gitu
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/menus'), $imageName);
                $menu->image = 'images/menus/'.$imageName;
            }

            $menu->save(); //ini buat ngesave

        return redirect()->route('admin.menu.create')->with('success', 'Menu item created successfully.');
    }

    public function cancelOrder($id){ //ini buat ngecancel order
        $order = Order::findOrFail($id);
        $order->status = 'Canceled';
        $order->delete();

        return redirect()->back()->with('success', 'Order canceled successfullyy');
    }

}
