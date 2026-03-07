<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Faculties (Colleges)
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->string('code', 20)->unique();
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->string('dean_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('building')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Departments
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('name_en');
            $table->string('code', 20)->unique();
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->string('head_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Academic Years
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_current')->default(false);
            $table->boolean('is_registration_open')->default(false);
            $table->timestamps();
        });

        // Semesters
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_current')->default(false);
            $table->integer('order')->default(1);
            $table->timestamps();
        });

        // Courses
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->string('name_en');
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('credits')->default(3);
            $table->integer('hours_lecture')->default(3);
            $table->integer('hours_lab')->default(0);
            $table->integer('hours_tutorial')->default(0);
            $table->enum('level', ['1', '2', '3', '4', '5', '6', '7', '8'])->default('1');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Course Prerequisites
        Schema::create('course_prerequisites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('prerequisite_id')->constrained('courses')->onDelete('cascade');
            $table->timestamps();
        });

        // Professors
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('first_name_en');
            $table->string('last_name');
            $table->string('last_name_en');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('specialization')->nullable();
            $table->string('degree')->nullable();
            $table->text('qualifications')->nullable();
            $table->string('office')->nullable();
            $table->string('office_hours')->nullable();
            $table->enum('status', ['active', 'on_leave', 'retired'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // Students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->nullable()->constrained()->onDelete('set null');
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('first_name_en');
            $table->string('last_name');
            $table->string('last_name_en');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('national_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('high_school')->nullable();
            $table->float('high_school_grade')->nullable();
            $table->enum('status', ['new', 'active', 'on_probation', 'suspended', 'graduated', 'withdrawn'])->default('new');
            $table->integer('current_level')->default(1);
            $table->float('gpa')->default(0);
            $table->integer('total_credits')->default(0);
            $table->date('admission_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Course Sections
        Schema::create('course_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->foreignId('professor_id')->nullable()->constrained('professors')->onDelete('set null');
            $table->string('section_number', 10);
            $table->integer('capacity')->default(30);
            $table->integer('enrolled_count')->default(0);
            $table->string('room')->nullable();
            $table->string('schedule')->nullable();
            $table->enum('status', ['open', 'closed', 'cancelled'])->default('open');
            $table->timestamps();
            $table->unique(['course_id', 'semester_id', 'section_number']);
        });

        // Enrollments
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_section_id')->constrained('course_sections')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['registered', 'dropped', 'completed', 'failed', 'incomplete'])->default('registered');
            $table->date('enrollment_date')->nullable();
            $table->date('drop_date')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'course_section_id', 'semester_id']);
        });

        // Grades
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->string('letter_grade')->nullable();
            $table->float('percentage')->nullable();
            $table->float('grade_points')->nullable();
            $table->text('notes')->nullable();
            $table->date('submission_date')->nullable();
            $table->timestamps();
        });

        // Attendance
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_section_id')->constrained('course_sections')->onDelete('cascade');
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'course_section_id', 'date']);
        });

        // Fees
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // tuition, registration, library, lab, etc.
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_per_credit')->default(false);
            $table->boolean('is_mandatory')->default(true);
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        // Student Fees
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'paid', 'partial', 'waived', 'overdue'])->default('pending');
            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_fee_id')->nullable()->constrained()->onDelete('set null');
            $table->string('receipt_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable(); // cash, card, bank_transfer
            $table->string('transaction_id')->nullable();
            $table->date('payment_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Library Books
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique()->nullable();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('publication_year')->nullable();
            $table->string('edition')->nullable();
            $table->integer('pages')->nullable();
            $table->string('category')->nullable();
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->default(1);
            $table->string('shelf_location')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Library Transactions
        Schema::create('library_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('checkout_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'overdue', 'lost'])->default('borrowed');
            $table->integer('renewal_count')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_transactions');
        Schema::dropIfExists('books');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('student_fees');
        Schema::dropIfExists('fees');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('course_sections');
        Schema::dropIfExists('course_prerequisites');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('academic_years');
        Schema::dropIfExists('students');
        Schema::dropIfExists('professors');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('faculties');
    }
};
