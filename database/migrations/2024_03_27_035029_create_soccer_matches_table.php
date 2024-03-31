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
        Schema::create('soccer_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('match_date');
            $table->integer('home_team_goals')->default(0);
            $table->integer('away_team_goals')->default(0);
            $table->boolean('played')->default(false);
            $table->boolean('finished')->default(false);
            $table->foreignId('home_team_id')->constrained('teams');
            $table->foreignId('away_team_id')->constrained('teams');
            $table->foreignId('referee_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soccer_matches');
    }
};
