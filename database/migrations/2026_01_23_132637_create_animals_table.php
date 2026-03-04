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
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id'); // автоинкрементный первичный ключ
            $table->string('data', 255);
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });

        DB::table('animals')->insert([
            [
                'id' => '1',
                'data' => 'all',
                'name' => 'Для всех',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'data' => 'cattle',
                'name' => 'Для КРС',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'data' => 'horse',
                'name' => 'Для Лошадей',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '4',
                'data' => 'pig',
                'name' => 'Для Свиней',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5',
                'data' => 'bird',
                'name' => 'Для Птиц',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
