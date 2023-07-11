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
        Schema::table('eductional_questions', function (Blueprint $table) {
            $table->integer('titel_id')->unsigned();
            $table->foreign('titel_id')->references('id')->on('titels')->constrained()->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eductional_questions', function (Blueprint $table) {
            //
        });
    }
};