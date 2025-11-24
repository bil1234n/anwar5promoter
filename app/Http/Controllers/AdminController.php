<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Donation;  
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function manageUsers(Request $request)
    {
        // 1. Query Builder
        $query = User::query();

        // --- CRITICAL FIX: Exclude the currently logged-in Admin ---
        $query->where('id', '!=', Auth::id());

        // Apply Search Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phoneNo', 'like', "%{$search}%");
            });
        }

        // Apply Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply Role Filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 2. Fetch Users for the Table (Paginated)
        $users = $query->latest()->paginate(10)->withQueryString();

        // 3. Statistics (Global Counts - includes everyone)
        $totalUsers = User::count(); 
        $pendingUsers = User::where('status', 'pending')->count();
        $premiumUsers = User::where('member_status', 'premium')->count();
        $suspendedUsers = User::where('status', 'suspend')->count();

        // 4. Data for Charts
        $userStatusCounts = User::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $memberCounts = User::selectRaw('member_status, count(*) as count')
            ->groupBy('member_status')
            ->pluck('count', 'member_status')
            ->toArray();

        return view('admin.manageUsers', compact(
            'users', 
            'totalUsers', 
            'pendingUsers', 
            'premiumUsers', 
            'suspendedUsers',
            'userStatusCounts',
            'memberCounts'
        ));
    }
    
    // Kept this for the separate edit page if you use it
    public function editUser($id)
    {
        // Security: Prevent editing yourself
        if ($id == Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot edit your own account from the Admin panel.');
        }

        $user = User::findOrFail($id);
        return view('admin.userEdit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // 1. Security Check: Prevent Admin from suspending themselves
        if ($id == Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Action denied. You cannot modify your own administrative account.']);
        }

        $user = User::findOrFail($id);

        // 2. Validation
        $request->validate([
            'username'      => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'phoneNo'       => 'nullable|string|max:20',
            'role'          => 'required|in:admin,user',
            'member_status' => 'required|in:none,silver,gold,premium',
            'status'        => 'required|in:approve,suspend,pending',
        ]);

        // 3. Update
        $user->update($request->only([
            'username', 'email', 'phoneNo', 'role', 'member_status', 'status'
        ]));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function donations(Request $request)
    {
        // 1. Base Query
        $query = Donation::latest();

        // 2. Filter by Purpose
        if ($request->has('purpose') && $request->purpose != 'all') {
            $query->where('purpose', $request->purpose);
        }

        $donations = $query->get();
        
        // 3. For the Dropdown Filter
        $allPurposes = Donation::select('purpose')->distinct()->pluck('purpose');

        // 4. Data for "Purpose" Doughnut Chart
        // Groups by purpose and sums the amount
        $chartPurpose = Donation::select('purpose', DB::raw('sum(amount) as total_amount'))
            ->where('status', 'success') // Only count successful donations
            ->groupBy('purpose')
            ->get();

        // 5. Data for "Trend" Line Chart (Last 30 Days)
        $chartTrend = Donation::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
            ->where('status', 'success')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return view('admin.donated', compact('donations', 'allPurposes', 'chartPurpose', 'chartTrend'));
    }
}