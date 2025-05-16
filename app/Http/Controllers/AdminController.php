<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminUserView(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $users = User::where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
            $users = User::orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('admin_panel.users', compact('users', 'search'));
    }

    public function toggleStatus(Request $request)
    {
        // print_r($request->all());

        $user = User::findOrFail($request->userId);
        $user->status = !$user->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'status' => $user->status
        ]);
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->password = Hash::make($validated['password']);
        $user->status = true;

        // if ($request->hasFile('image')) {
        //     $path = $request->file('image')->store('public/users');
        //     $user->image = str_replace('public/', '', $path);
        // }

        $user->save();

        return redirect()->route('admin.users.view')->with('success', 'User created successfully!');
    }

    public function getUser(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'full_name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'status' => $user->status,
                // 'image_url' => $user->image ? asset('storage/' . $user->image) : asset('assets/images/users/avatar-1.jpg'),
                'created_at' => $user->created_at->format('M d, Y h:i A'),
                'updated_at' => $user->updated_at->format('M d, Y h:i A'),
            ]
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // if ($request->hasFile('image')) {
        //     // Delete old image if exists
        //     if ($user->image) {
        //         Storage::delete('public/' . $user->image);
        //     }

        //     $path = $request->file('image')->store('public/users');
        //     $user->image = str_replace('public/', '', $path);
        // }

        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!'
            ]);
        }

        return redirect()->route('admin.users.view')->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        try {
            // Delete user image if exists
            // if ($user->image) {
            //     Storage::delete('public/' . $user->image);
            // }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function adminIndex()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', true)->count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin_panel.dashboard', compact('totalUsers', 'activeUsers', 'recentUsers'));
    }

    public function index()
    {
        return view('admin_panel.hospitals');
    }

    public function create()
    {
        return view('admin_panel.hospital_Create');
    }
}