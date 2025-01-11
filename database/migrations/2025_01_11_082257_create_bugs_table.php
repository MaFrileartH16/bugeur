<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('bugs', function (Blueprint $table) {
      $table->id('bug_id');
      $table->unsignedBigInteger('project_id');
      $table->string('title');
      $table->unsignedBigInteger('assignee_id');
      $table->enum('status', ['open', 'in_progress', 'resolved', 'closed']);
      $table->text('description');
      $table->unsignedBigInteger('creator_id');
      $table->date('deadline');
      $table->enum('bug_type', ['critical', 'major', 'minor']);
      $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
      $table->foreign('assignee_id')->references('id')->on('users')->onDelete('set null');
      $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bugs');
  }
};