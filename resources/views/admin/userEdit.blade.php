@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Edit User: {{ $user->username }}</h2>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                        &larr; Back to List
                    </a>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Column 1: Personal Info --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Personal Information</h3>

                            {{-- Profile Picture Display --}}
                            <div class="flex items-center space-x-4">
                                <img class="h-20 w-20 rounded-full object-cover border" 
                                     src="{{ \Illuminate\Support\Facades\Storage::url( $user->profile_p) }}" 
                                     onerror="this.src='https://ui-avatars.com/api/?name={{urlencode($user->username)}}'"
                                     alt="Profile">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Profile Picture (Path)</label>
                                    <input type="text" disabled value="{{ $user->profile_p }}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="phoneNo" class="block text-sm font-medium text-gray-700">Phone No</label>
                                <input type="text" name="phoneNo" id="phoneNo" value="{{ old('phoneNo', $user->phoneNo) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        {{-- Column 2: Admin Controls --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Administrative Controls</h3>

                            {{-- Role --}}
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">User Role</label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            {{-- Membership Status --}}
                            <div>
                                <label for="member_status" class="block text-sm font-medium text-gray-700">Membership Status</label>
                                <select name="member_status" id="member_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="none" {{ $user->member_status == 'none' ? 'selected' : '' }}>None</option>
                                    <option value="silver" {{ $user->member_status == 'silver' ? 'selected' : '' }}>Silver</option>
                                    <option value="gold" {{ $user->member_status == 'gold' ? 'selected' : '' }}>Gold</option>
                                    <option value="premium" {{ $user->member_status == 'premium' ? 'selected' : '' }}>Premium</option>
                                </select>
                            </div>

                            {{-- Account Status --}}
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Account Status</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approve" {{ $user->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="suspend" {{ $user->status == 'suspend' ? 'selected' : '' }}>Suspend</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">"Suspend" will block the user from logging in.</p>
                            </div>

                            {{-- Documents Links --}}
                            <div class="bg-gray-50 p-4 rounded-md border border-gray-200 mt-4">
                                <h4 class="text-sm font-bold text-gray-700 mb-2">Uploaded Documents</h4>
                                <ul class="text-sm text-blue-600 space-y-1">
                                    <li>
                                        @if($user->id_card)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url($user->id_card) }}" target="_blank" class="hover:underline">📄 View ID Card</a>
                                        @else
                                            <span class="text-gray-400">No ID Card uploaded</span>
                                        @endif
                                    </li>
                                    <li>
                                        @if($user->passport)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url($user->passport) }}" target="_blank" class="hover:underline">📄 View Passport</a>
                                        @else
                                            <span class="text-gray-400">No Passport uploaded</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t pt-6">
                        <a href="{{ route('admin.users.index') }}" class="mr-3 inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection