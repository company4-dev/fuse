<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->string('name')->nullable();
            $table->string('disk');
            $table->string('group')->nullable();
            $table->boolean('encrypted')->default(true);
            $table->morphs('fileable');
            $table->text('folder')->nullable();
            $table->string('path');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
