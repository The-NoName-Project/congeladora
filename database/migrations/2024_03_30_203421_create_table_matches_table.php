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
        Schema::create('table_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('team_id')->unique()->constrained('teams');
            $table->integer('matches');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('draws');
            $table->integer('points');
            $table->integer('goals_for');
            $table->integer('goal_difference');
            $table->integer('goals_against');
            $table->foreignId('category_id')->constrained('categories');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_matches');
    }
};
