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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->string('code')->unique();
        $table->string('category');
        $table->string('status')->default('pending');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps(); // ✅ Keep this last
    });
}

    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
