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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('stock')->default(0);
            $table->string('unit'); // pcs, pack, box, etc.
            $table->decimal('buy_price', 15, 2);
            $table->decimal('sell_price', 15, 2);
            $table->integer('min_stock')->default(20);
            $table->string('weight')->nullable(); // e.g. 500 gram
            $table->string('storage_location')->nullable(); // e.g. Rak A-3
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
