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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('role_id')->default(1);
            $table->unsignedSmallInteger('class')->nullable();
            $table->string('section', 2)->nullable();
            $table->string('surname')->nullable();
            
            $table->string('school')->nullable();
            $table->foreign('school')
                  ->references('codicescuola')
                  ->on('schools')
                  ->onDelete('cascade');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role_id', 'class', 'section', 'school']);
        });
    }
};
