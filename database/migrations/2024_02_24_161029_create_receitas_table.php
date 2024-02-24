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
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            
            $table->string('descricao',255)
                ->nullable(false);

            $table->float('valor',8,2)
                ->nullable(false)
                ->default(0);

            $table->date('data')
                ->nullable(false)
                ->default(now());

            $table->string('tipo',1)
                ->nullable(false)
                ->default('C');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
