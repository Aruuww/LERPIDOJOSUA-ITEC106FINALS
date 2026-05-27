<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('model');
            $table->string('year', 4);
            $table->string('color');
            $table->string('plate_number')->unique();
            $table->enum('type', ['Sedan', 'SUV', 'Coupe', 'Convertible', 'Wagon', 'Hatchback']);
            $table->decimal('price', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
