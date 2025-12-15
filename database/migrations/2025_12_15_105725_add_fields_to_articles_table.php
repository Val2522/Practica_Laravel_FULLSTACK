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
        Schema::table('articles', function (Blueprint $table) {
            // Campos que necesita la app para artículos
            $table->string('title');
            $table->text('body');
            $table->string('author');
            $table->date('date');
            // Relación con usuarios; elimina en cascada al borrar el usuario
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Revierto los campos añadidos
            $table->dropColumn(['title', 'body', 'author', 'date']);
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
