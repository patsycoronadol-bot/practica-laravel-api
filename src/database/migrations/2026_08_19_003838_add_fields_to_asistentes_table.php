<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('asistentes', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->unsignedBigInteger('evento_id');

            $table->foreign('evento_id')
                  ->references('id')
                  ->on('eventos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('asistentes', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
            $table->dropColumn([
                'nombre',
                'email',
                'telefono',
                'evento_id',
            ]);
        });
    }
};

