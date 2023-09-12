<?php

use App\Enums\Color;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');;
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->tinyText('attendees')->nullable();
            $table->string('color')->default("#F4B400");
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
