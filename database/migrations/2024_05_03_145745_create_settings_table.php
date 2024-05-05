<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('register')->default(1);
            $table->timestamps();
        });
        
        DB::table('settings')->insert([
            [
                'register' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
