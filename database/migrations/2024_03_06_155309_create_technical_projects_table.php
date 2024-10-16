<?php

use App\Models\projects;
use App\Models\technicals;
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
        Schema::create('technical_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(projects::class);
            $table->foreignIdFor(technicals::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_projects');
    }
};
