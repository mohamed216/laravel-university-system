<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add soft deletes to tables that are missing them
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('student_fees', function (Blueprint $table) {
            if (!Schema::hasColumn('student_fees', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('fees', function (Blueprint $table) {
            if (!Schema::hasColumn('fees', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('grades', function (Blueprint $table) {
            if (!Schema::hasColumn('grades', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('enrollments', function (Blueprint $table) {
            if (!Schema::hasColumn('enrollments', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('course_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('course_sections', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('semesters', function (Blueprint $table) {
            if (!Schema::hasColumn('semesters', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        Schema::table('academic_years', function (Blueprint $table) {
            if (!Schema::hasColumn('academic_years', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('student_fees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('grades', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('course_sections', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('semesters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('academic_years', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
