<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_section_id')->constrained('course_sections')->onDelete('cascade');
            $table->foreignId('professor_id')->constrained('professors')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('meeting_link')->nullable(); // Zoom, Google Meet, etc.
            $table->string('video_url')->nullable(); // YouTube, Vimeo link
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();
            $table->datetime('scheduled_at');
            $table->integer('duration_minutes')->default(60);
            $table->enum('status', ['scheduled', 'live', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->boolean('is_recording_enabled')->default(true);
            $table->text('recording_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('online_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_lecture_id')->constrained('online_lectures')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->datetime('joined_at')->nullable();
            $table->datetime('left_at')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->boolean('is_present')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['online_lecture_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_attendances');
        Schema::dropIfExists('online_lectures');
    }
};
