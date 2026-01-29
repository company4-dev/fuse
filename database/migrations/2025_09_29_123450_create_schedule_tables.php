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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('end_after')->nullable();
            $table->time('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('schedule');
            $table->tinyInteger('recurrence_type')->nullable();
            $table->smallInteger('every')->nullable();
            $table->string('every_on', 13)->nullable();
            $table->tinyInteger('day')->nullable();
            $table->tinyInteger('week')->nullable();
            $table->tinyInteger('dow')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->morphs('assignee');
            $table->string('generates')->nullable();
            $table->foreignId('created_by')->references('id')->on('users');
            $table->foreignId('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('schedule_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id')->unsigned()->index();
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->string('type')->default('null');
            $table->string('key')->index();
            $table->text('value')->nullable();

            $table->timestamps();
        });
        Schema::create('schedule_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            $table->string('generated_type')->nullable();
            $table->bigInteger('generated_id')->nullable();
            $table->boolean('processed')->default(false);
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_dates');
        Schema::dropIfExists('schedule_meta');
        Schema::dropIfExists('schedules');
    }
};
