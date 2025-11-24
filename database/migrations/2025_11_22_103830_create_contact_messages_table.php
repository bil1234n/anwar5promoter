<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            // Link to Users table (nullable allows guests to send messages too, if desired)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('email');
            $table->string('company');
            $table->string('subject');
            $table->text('message');
            $table->text('admin_reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_messages');
    }
};