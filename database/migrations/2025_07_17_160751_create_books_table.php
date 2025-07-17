<?php

use App\Traits\BaseModelSoftDelete;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseModelSoftDelete;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('category_id')->constrained('category');
            $table->string('book_code', 16)->unique(); 
            $table->string('title', 255); 
            $table->string('image', 128); 
            $table->string('author', 128); 
            $table->text('desc')->nullable();
            $table->date('year_publish'); 
            $table->integer('quantity');
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
