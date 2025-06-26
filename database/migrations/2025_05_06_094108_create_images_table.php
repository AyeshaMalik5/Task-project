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
                Schema::create('images', function (Blueprint $table) {
                    $table->id();
                    $table->string('image_path'); // Stores the path to the image
                    $table->unsignedBigInteger('task_id'); // Foreign key to tasks table
                    $table->timestamps();
        
                    // Define foreign key constraint
                    $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
                });
            }
        
            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('images');
            }
        };
        

