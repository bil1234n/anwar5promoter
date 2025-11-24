<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            // Link to the logged-in user
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // We keep specific contact info just in case they want to use different details than their account
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('other_information')->nullable();
            
            // Status column
            $table->string('status')->default('pending'); // pending, approved, denied
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
