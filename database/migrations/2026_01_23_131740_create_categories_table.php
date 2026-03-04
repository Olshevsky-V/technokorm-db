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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); // автоинкрементный первичный ключ
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            [
                'id' => '1',
                'name' => 'Все',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'name' => 'Профилактика',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'name' => 'Ракушка',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '4',
                'name' => 'Соль-лизунец',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5',
                'name' => 'ЗЦМ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '6',
                'name' => 'Премиксы',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '7',
                'name' => 'БВМК',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '8',
                'name' => 'Комбикорма',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '9',
                'name' => 'Трикальцийфосфат',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '10',
                'name' => 'Сода пищевая',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '11',
                'name' => 'Мел кормовой',
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
        Schema::dropIfExists('categories');
    }
};
