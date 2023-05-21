<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('advice', function (Blueprint $table) {
            $table->integer('child_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->constrained()->onDelete('cascade');

        });
    }


    public function down(): void
    {
        Schema::table('advice', function (Blueprint $table) {
            $table->dropColumn('child_id') ;
        });
    }
};
