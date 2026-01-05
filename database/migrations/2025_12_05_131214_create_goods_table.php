<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id(); // авто-increment, первичный ключ
            $table->string('name');
            $table->json('categories'); // JSON для массива категорий
            $table->text('tags'); // JSON-строка с тегами
            $table->string('image')->default(''); // путь к изображению
            $table->unsignedInteger('price')->nullable(); // цена, может быть NULL
            $table->timestamps(); // поля created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
