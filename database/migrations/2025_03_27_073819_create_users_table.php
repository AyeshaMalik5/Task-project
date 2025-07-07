<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        
        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create('users', function (Blueprint $table) {
                    $table->id(); // Auto-increment primary key
                    $table->string('name'); // User name
                    $table->string('email')->unique(); // Unique email
                    $table->string('password'); // Password (hashed)
                    $table->string('role')->     default('Employee');; // User role (e.g., admin, employee)
                    $table->timestamps(); // Created_at & Updated_at timestamps
                    $table->timestamp('email_verified_at')->nullable();
                    $table->rememberToken();
              
                });
            }
        
            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('users');
            }
        };
    