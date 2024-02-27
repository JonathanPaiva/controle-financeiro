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
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            
            $table->string('descricao',255)
                ->nullable(false);
            
            $table->float('valor',8,2)
                ->nullable(false)
                ->default(0);
            
            $table->date('data')
                ->nullable(false)
                ->default(now());
            
            $table->string('categoria',25)
                ->nullable(false)
                ->default('Outras');
            
            $table->string('tipo',1)
                ->nullable(false)
                ->default('D');
            
            $table->string('grupo',20)
                ->nullable(false);
            
            $table->timestamps();
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
