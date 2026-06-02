<?php

namespace App\Providers;


use App\Repository\AttendanceRepository;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\ExamRepository;
use App\Repository\ExamRepositoryInterface;
use App\Repository\FeeInvoiceRepository;
use App\Repository\FeeInvoiceRepositoryInterface;
use App\Repository\FeeRepository;
use App\Repository\FeeRepositoryInterface;
use App\Repository\LibraryRepository;
use App\Repository\LibraryRepositoryInterface;
use App\Repository\PaymentRepository;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProcessingFeeRepository;
use App\Repository\ProcessingFeeRepositoryInterface;
use App\Repository\PromotionRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\QuestionRepository;
use App\Repository\QuestionRepositoryInterface;
use App\Repository\QuizzRepository;
use App\Repository\QuizzRepositoryInterface;
use App\Repository\ReceiptStudentRepository;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\StudentGraduateRepositoryInterface;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\SubjectRepository;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\TeacherRepository;
use App\Repository\StudentGraduateRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class,TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class,PromotionRepository::class);
        $this->app->bind(StudentGraduateRepositoryInterface::class,StudentGraduateRepository::class);
        $this->app->bind(FeeRepositoryInterface::class,FeeRepository::class);
        $this->app->bind(FeeInvoiceRepositoryInterface::class,FeeInvoiceRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class,ReceiptStudentRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class,ProcessingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class,AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->bind(ExamRepositoryInterface::class,ExamRepository::class);
        $this->app->bind(QuizzRepositoryInterface::class,QuizzRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class,QuestionRepository::class);
        $this->app->bind(LibraryRepositoryInterface::class,LibraryRepository::class);


        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
