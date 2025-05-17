<?php

use App\Http\Controllers\admin\AdminDashboard;
use App\Http\Controllers\admin\AdminLevel;
use App\Http\Controllers\admin\AdminLogin;
use App\Http\Controllers\admin\ApplicationsC;
use App\Http\Controllers\admin\BlogC;
use App\Http\Controllers\admin\BlogCategoryC;
use App\Http\Controllers\admin\CourseCategoryC;
use App\Http\Controllers\admin\CreateExamsC;
use App\Http\Controllers\admin\CreateUserC;
use App\Http\Controllers\admin\EventC;
use App\Http\Controllers\admin\ExamDateScheduleC;
use App\Http\Controllers\admin\ExamInstructionC;
use App\Http\Controllers\admin\ExamQuestionsC;
use App\Http\Controllers\admin\ExamSubjectsC;
use App\Http\Controllers\admin\ExternalScholarshipC;
use App\Http\Controllers\admin\FollowUpStatusC;
use App\Http\Controllers\admin\FollowUpTypeC;
use App\Http\Controllers\admin\InquiryC;
use App\Http\Controllers\admin\LeadStatusC;
use App\Http\Controllers\admin\LeadSubStatusC;
use App\Http\Controllers\admin\LeadTypeC;
use App\Http\Controllers\admin\LevelDocumentC;
use App\Http\Controllers\admin\ProviderC;
use App\Http\Controllers\admin\ProviderFaqC;
use App\Http\Controllers\admin\ProviderPhotoGalleryC;
use App\Http\Controllers\admin\ProviderTypeC;
use App\Http\Controllers\admin\ProviderVideoGalleryC;
use App\Http\Controllers\admin\ScholarshipC;
use App\Http\Controllers\admin\ScholarshipContentC;
use App\Http\Controllers\admin\ScholarshipCustomEligibilityC;
use App\Http\Controllers\admin\ScholarshipEligibilityC;
use App\Http\Controllers\admin\ScholarshipLevelC;
use App\Http\Controllers\admin\ScholarshipSubjectC;
use App\Http\Controllers\admin\ServicesC;
use App\Http\Controllers\admin\SpecializationC;
use App\Http\Controllers\admin\StudentC;
use App\Http\Controllers\admin\StudentFollowUpC;
use App\Http\Controllers\admin\StudentProfileC;
use App\Http\Controllers\admin\TestimonialC;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\employee\EmpDashboardC;
use App\Http\Controllers\employee\EmpLoginC;
use App\Http\Controllers\employee\EmpStudentC;
use App\Http\Controllers\front\AboutFc;
use App\Http\Controllers\front\BlogFc;
use App\Http\Controllers\front\ContactFc;
use App\Http\Controllers\front\EventFc;
use App\Http\Controllers\front\HomeFc;
use App\Http\Controllers\front\ProviderFc;
use App\Http\Controllers\front\ScholarshipFc;
use App\Http\Controllers\front\ServicesFc;
use App\Http\Controllers\front\TestimonialFc;
use App\Http\Controllers\provider\PostScholarshipFc;
use App\Http\Controllers\provider\ProviderAccountFc;
use App\Http\Controllers\provider\ProviderLoginFc;
use App\Http\Controllers\student\StudentApplicationFc;
use App\Http\Controllers\student\StudentAppliedScholarshipFc;
use App\Http\Controllers\student\StudentFc;
use App\Http\Controllers\student\StudentLoginFc;
use App\Http\Controllers\student\StudentPaymentFc;
use App\Http\Controllers\test\StudentTestFc;
use App\Http\Middleware\StudentLoggedIn;
use App\Http\Middleware\StudentLoggedOut;
use App\Http\Middleware\AdminLoggedIn;
use App\Http\Middleware\AdminLoggedOut;
use App\Http\Middleware\EmployeeLoggedIn;
use App\Http\Middleware\EmployeeLoggedOut;
use App\Http\Middleware\ProviderLoggedIn;
use App\Http\Middleware\ProviderLoggedOut;
use App\Models\Level;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('send-email', [StudentLoginFc::class, 'sendMail']);
/* ARTISAN CAMMAND */

//Clear Cache facade value:
Route::get('/clear-cache', function () {
  $exitCode = Artisan::call('cache:clear');
  return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
  $exitCode = Artisan::call('optimize');
  return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
  $exitCode = Artisan::call('route:cache');
  return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
  $exitCode = Artisan::call('route:clear');
  return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
  $exitCode = Artisan::call('view:clear');
  return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
  $exitCode = Artisan::call('config:cache');
  return '<h1>Clear Config cleared</h1>';
});

//For MIgrate:
Route::get('/migrate', function () {
  $exitCode = Artisan::call('migrate');
  return '<h1>Migrated</h1>';
});

Route::get('/db-seed', function () {
  $exitCode = Artisan::call('db:seed');
  return $exitCode . '<br><h1>Database seeding completed successfully.</h1>';
});

/* FRONT ROUTES */
Route::get('exam-question/export/{exam_id}', [ExamQuestionsC::class, 'Export']);
Route::get('/', [HomeFc::class, 'home']);
//Route::get('/', [HomeFc::class, 'index']);
//Route::get('/', [ScholarshipFc::class, 'index']);
Route::get('/home', [HomeFc::class, 'index']);
Route::get('/about', [AboutFc::class, 'index']);
Route::get('/about-mudra-education', [AboutFc::class, 'mudraEducation']);
Route::get('/about-scholarship', [AboutFc::class, 'scholarship']);
Route::get('/scholarships', [ScholarshipFc::class, 'index']);
Route::get('/blogs', [BlogFc::class, 'index']);
Route::get('/contact-us', [ContactFc::class, 'index']);
Route::post('/contact-us', [ContactFc::class, 'submitInquiry']);
Route::get('/testimonials', [TestimonialFc::class, 'index']);
Route::get('/eligibility-criteria', [HomeFc::class, 'eligibilityCriteria']);
Route::get('/terms-conditions', [HomeFc::class, 'termsConditions']);
Route::get('/privacy-policy', [HomeFc::class, 'privacyPolicy']);
Route::get('/disclaimer', [HomeFc::class, 'disclaimer']);
Route::get('/copyright-policy', [HomeFc::class, 'copyrightPolicy']);
Route::get('/cancellation-refund', [HomeFc::class, 'cancellationRefund']);

$alllvl = Level::all();
foreach ($alllvl as $lvl) {
  Route::get('/' . $lvl->seo_name_slug . '-scholarships/', [ScholarshipFc::class, 'scholarshipByLevel']);
}

Route::get('/scholarship/{id}/{slug}', [ScholarshipFc::class, 'scholarshipDetail']);
Route::get('/scholarship/{id}/{slug}/instruction', [ScholarshipFc::class, 'scholarshipDetailInstruction']);

Route::get('/providers', [ProviderFc::class, 'index']);
// $pro = Provider::all();
// foreach ($pro as $pro) {
Route::get('/provider/{slug}', [ProviderFc::class, 'providerDetail']);
Route::get('/provider/{slug}/scholarship', [ProviderFc::class, 'scholarship']);
Route::get('/provider/{slug}/gallery', [ProviderFc::class, 'gallery']);
Route::get('/provider/{slug}/faqs', [ProviderFc::class, 'faqs']);
//}

Route::get('/events', [EventFc::class, 'index']);
Route::get('/event/{id}/{slug}', [EventFc::class, 'eventDetail']);

Route::get('/services', [ServicesFc::class, 'index']);
Route::get('/service/{id}/{slug}', [ServicesFc::class, 'serviceDetail']);
Route::post('/get-quote', [ServicesFc::class, 'submitInquiry']);

Route::get('/blogs', [BlogFc::class, 'index']);
Route::get('/blogs/{slug}', [BlogFc::class, 'index']);
Route::get('/blog/{id}/{slug}', [BlogFc::class, 'Details']);

Route::get('/student/scholarship/exam/payment', [StudentPaymentFc::class, 'index']);
Route::post('/student/scholarship/exam/payment', [StudentPaymentFc::class, 'payment']);
Route::get('/student/scholarship/get-spc-by-cat-sch', [StudentApplicationFc::class, 'getSpcByCatSch']);
Route::get('/student/scholarship/get-exam-date-schedule', [StudentApplicationFc::class, 'getExamDateSchedule']);
Route::get('/student/get-exam-id-for-student', [StudentApplicationFc::class, 'getExamIdForStudent']);

/* STUDENT ROUTES BEFORE LOGIN */
Route::middleware([StudentLoggedOut::class])->group(function () {
  Route::get('/login', [StudentLoginFc::class, 'login']);
  Route::post('/student-login', [StudentLoginFc::class, 'signin']);
  Route::get('/signup', [StudentLoginFc::class, 'signup']);
  Route::post('/student-signup', [StudentLoginFc::class, 'register']);
  Route::get('/confirmed-email', [StudentLoginFc::class, 'confirmedEmail']);
  Route::post('/submit-email-otp', [StudentLoginFc::class, 'submitOtp']);
  Route::get('/forget-password', [StudentLoginFc::class, 'viewForgetPassword']);
  Route::post('/forget-password', [StudentLoginFc::class, 'forgetPassword']);
  Route::get('/forget-password/email-sent', [StudentLoginFc::class, 'emailSent']);
  Route::get('/email-login', [StudentLoginFc::class, 'emailLogin']);
  Route::get('/profile/password/reset', [StudentLoginFc::class, 'viewResetPassword']);
  Route::get('/account/invalid_link', [StudentLoginFc::class, 'invalidLink']);
  Route::post('/reset-password', [StudentLoginFc::class, 'resetPassword']);
});
/* STUDENT ROUTES AFTER LOGIN */
Route::middleware([StudentLoggedIn::class])->group(function () {
  Route::prefix('profile')->group(function () {
    Route::get('', [StudentFc::class, 'profile']);
    Route::get('/success', [StudentFc::class, 'success']);
    Route::get('/edit', [StudentFc::class, 'editProfile']);
    Route::post('/update', [StudentFc::class, 'updateProfile']);
    Route::get('/change-password', [StudentFc::class, 'viewChangePassword']);
    Route::post('/change-password', [StudentFc::class, 'changePassword']);
    Route::get('/applied-scholarship', [StudentAppliedScholarshipFc::class, 'appliedScholarship']);
  });

  Route::get('/get-course-categories/{scholarshipId}', [StudentFc::class, 'getCourseCategories'])->name('get-course-categories');
  Route::prefix('scholarship')->group(function () {
    Route::get('/application', [StudentApplicationFc::class, 'studentApplication']);
    Route::get('/shortlist', [StudentApplicationFc::class, 'shortlist']);
    Route::post('/apply', [StudentApplicationFc::class, 'applyScholarship']);
    Route::get('/personal-details', [StudentApplicationFc::class, 'personalDetails']);
    Route::post('/personal-details', [StudentApplicationFc::class, 'addPersonalDetails']);
    Route::get('/contact-details', [StudentApplicationFc::class, 'contactDetails']);
    Route::post('/contact-details', [StudentApplicationFc::class, 'addContactDetails']);
    Route::get('/academics-details', [StudentApplicationFc::class, 'academicsDetails']);
    Route::post('/academics-details', [StudentApplicationFc::class, 'addAcademicsDetails']);
    Route::post('/academics-details/update', [StudentApplicationFc::class, 'updateAcademicsDetails']);
    Route::get('/documents', [StudentApplicationFc::class, 'documents']);
    Route::get('/upload-documents', [StudentApplicationFc::class, 'uploadDocuments']);
    Route::post('/upload-documents', [StudentApplicationFc::class, 'uploadDocuments']);

    Route::post('/check-eligibility', [StudentApplicationFc::class, 'checkEligibility']);

    Route::get('/{scholarship_id}/{slug}/apply', [StudentApplicationFc::class, 'apply']);
  });
  Route::get('/student-logout', function () {
    session()->forget('student_id');
    session()->forget('student_test_start');
    session()->forget('end_time');
    session()->forget('student_name');
    return redirect('login');
  });
  Route::get('/student/tests', [StudentFc::class, 'tests']);
  Route::get('/student/attended-tests', [StudentFc::class, 'attendedTests']);
  Route::get('/student/attended-test/{id}', [StudentFc::class, 'attendedTestDetails']);
  Route::prefix('/test')->group(function () {
    Route::post('/start-test', [StudentTestFc::class, 'submitStartTest']);
    Route::post('/start-test-a', [StudentTestFc::class, 'submitStartTesta']);
    Route::get('/{slug}/instruction', [StudentTestFc::class, 'instruction']);
    Route::get('/{slug}/start-test', [StudentTestFc::class, 'startTest']);
    Route::get('/{slug}', [StudentTestFc::class, 'test']);
    Route::get('/{slug}/{section_id}', [StudentTestFc::class, 'test']);
    Route::get('/{slug}/{section_id}/{question_id}', [StudentTestFc::class, 'test']);
  });
  Route::prefix('/run-test')->group(function () {
    Route::get('/save-answer', [StudentTestFc::class, 'saveAnswer']);
    Route::get('/complete', [StudentTestFc::class, 'complete']);
    Route::get('/report', [StudentTestFc::class, 'report']);
  });
});

/* PROVIDER ROUTES BEFORE LOGIN */
Route::middleware([ProviderLoggedOut::class])->group(function () {
  Route::prefix('provider')->group(function () {
    Route::get('/login', [ProviderLoginFc::class, 'login']);
    Route::post('/login', [ProviderLoginFc::class, 'signin']);
    Route::get('/signup', [ProviderLoginFc::class, 'signup']);
    Route::post('/signup', [ProviderLoginFc::class, 'register']);
    Route::get('/confirmed-email', [ProviderLoginFc::class, 'confirmedEmail']);
    Route::post('/submit-email-otp', [ProviderLoginFc::class, 'submitOtp']);
    Route::get('/forget-password', [ProviderLoginFc::class, 'viewForgetPassword']);
    Route::post('/forget-password', [ProviderLoginFc::class, 'forgetPassword']);
    Route::get('/forget-password/email-sent', [ProviderLoginFc::class, 'emailSent']);
    Route::get('/email-login', [ProviderLoginFc::class, 'emailLogin']);
    Route::get('/profile/password/reset', [ProviderLoginFc::class, 'viewResetPassword']);
    Route::get('/account/invalid_link', [ProviderLoginFc::class, 'invalidLink']);
    Route::post('/reset-password', [ProviderLoginFc::class, 'resetPassword']);
  });
});
/* PROVIDER ROUTES AFTER LOGIN */
Route::middleware([ProviderLoggedIn::class])->group(function () {
  Route::prefix('provider')->group(function () {
    Route::get('/', [ProviderAccountFc::class, 'profile']);
    Route::prefix('/profile')->group(function () {
      Route::get('', [ProviderAccountFc::class, 'profile']);
      Route::get('/edit', [ProviderAccountFc::class, 'editProfile']);
      Route::post('/update', [ProviderAccountFc::class, 'updateProfile']);
      Route::post('/update-logo', [ProviderAccountFc::class, 'updateLogo']);
      Route::get('/change-password', [ProviderAccountFc::class, 'viewChangePassword']);
      Route::post('/change-password', [ProviderAccountFc::class, 'changePassword']);
    });
    Route::prefix('/scholarship')->group(function () {
      Route::get('', [PostScholarshipFc::class, 'index']);
      Route::get('add', [PostScholarshipFc::class, 'add']);
      Route::post('store', [PostScholarshipFc::class, 'store']);
      Route::get('/delete/{id}', [PostScholarshipFc::class, 'delete']);
      Route::get('/{id}', [PostScholarshipFc::class, 'viewFullScholarship']);
      Route::post('/update', [PostScholarshipFc::class, 'update']);

      Route::prefix('/level')->group(function () {
        Route::post('store', [PostScholarshipFc::class, 'storeLevel']);
        Route::get('/delete/{id}', [PostScholarshipFc::class, 'deleteLevel']);
      });
      Route::prefix('/subject')->group(function () {
        Route::post('store', [PostScholarshipFc::class, 'storeSubject']);
        Route::get('/delete/{id}', [PostScholarshipFc::class, 'deleteSubject']);
      });
      Route::prefix('/country')->group(function () {
        Route::post('store', [PostScholarshipFc::class, 'storeCountry']);
        Route::get('/delete/{id}', [PostScholarshipFc::class, 'deleteCountry']);
      });
      Route::prefix('/custom-eligibility')->group(function () {
        Route::post('store', [PostScholarshipFc::class, 'storeCustomEligibility']);
        Route::get('/delete/{id}', [PostScholarshipFc::class, 'deleteCustomEligibility']);
      });
    });
    Route::get('/logout', function () {
      session()->forget('provider_id');
      return redirect('provider/login');
    });
  });
});

/* ADMIN ROUTES BEFORE LOGIN */
Route::middleware([AdminLoggedOut::class])->group(function () {
  Route::get('/admin/login/', [AdminLogin::class, 'index']);
  Route::post('/admin/login/', [AdminLogin::class, 'login']);
});
/* ADMIN ROUTES AFTER LOGIN */
Route::middleware([AdminLoggedIn::class])->group(function () {
  Route::get('/admin/logout/', function () {
    session()->forget('adminLoggedIn');
    return redirect('admin/login');
  });
  Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index']);
    Route::get('/dashboard', [AdminDashboard::class, 'index']);
    Route::get('/profile', [AdminDashboard::class, 'profile']);
    Route::post('/update-profile', [AdminDashboard::class, 'updateProfile']);

    Route::prefix('/levels')->group(function () {
      Route::get('', [AdminLevel::class, 'index']);
      Route::get('/update/{id}', [AdminLevel::class, 'index']);
      Route::post('/update/{id}', [AdminLevel::class, 'updateLevel']);
      Route::post('/store', [AdminLevel::class, 'addLevel']);
      Route::get('/delete/{id}', [AdminLevel::class, 'deleteLevel']);
    });
    Route::prefix('/level/')->group(function () {
      Route::prefix('/document')->group(function () {
        Route::get('/{level_id}', [LevelDocumentC::class, 'index']);
        Route::post('/store', [LevelDocumentC::class, 'store']);
        Route::get('/delete/{id}', [LevelDocumentC::class, 'delete']);
        Route::get('{level_id}/update/{id}', [LevelDocumentC::class, 'index']);
        Route::post('/update/{id}', [LevelDocumentC::class, 'update']);
      });
    });

    Route::get('/course-category/', [CourseCategoryC::class, 'index']);
    Route::post('/cc/store/', [CourseCategoryC::class, 'store']);
    Route::get('/cc/delete/{id}', [CourseCategoryC::class, 'delete']);
    Route::get('/course-category/update/{id}', [CourseCategoryC::class, 'index']);
    Route::post('/cc/update/{id}', [CourseCategoryC::class, 'update']);

    Route::get('/course-specialization/', [SpecializationC::class, 'index']);
    Route::post('/cs/store/', [SpecializationC::class, 'store']);
    Route::get('/cs/delete/{id}', [SpecializationC::class, 'delete']);
    Route::get('/course-specialization/update/{id}', [SpecializationC::class, 'index']);
    Route::post('/cs/update/{id}', [SpecializationC::class, 'update']);
    Route::post('/specialization/import', [SpecializationC::class, 'Import']);

    Route::get('/provider-type/', [ProviderTypeC::class, 'index']);
    Route::post('/pt/store/', [ProviderTypeC::class, 'store']);
    Route::get('/pt/delete/{id}', [ProviderTypeC::class, 'delete']);
    Route::get('/provider-type/update/{id}', [ProviderTypeC::class, 'index']);
    Route::post('/pt/update/{id}', [ProviderTypeC::class, 'update']);

    Route::get('/providers/', [ProviderC::class, 'index']);
    Route::post('/pr/store/', [ProviderC::class, 'store']);
    Route::get('/pr/delete/{id}', [ProviderC::class, 'delete']);
    Route::get('/providers/update/{id}', [ProviderC::class, 'index']);
    Route::post('/pr/update/{id}', [ProviderC::class, 'update']);

    Route::get('/provider-faq/{provider_id}', [ProviderFaqC::class, 'index']);
    Route::post('/profaq/store/', [ProviderFaqC::class, 'store']);
    Route::get('/profaq/delete/{id}', [ProviderFaqC::class, 'delete']);
    Route::get('/provider-faq/{provider_id}/update/{id}', [ProviderFaqC::class, 'index']);
    Route::post('/profaq/update/{id}', [ProviderFaqC::class, 'update']);

    Route::get('/provider-photo/{provider_id}', [ProviderPhotoGalleryC::class, 'index']);
    Route::post('/prophoto/store/', [ProviderPhotoGalleryC::class, 'store']);
    Route::get('/prophoto/delete/{id}', [ProviderPhotoGalleryC::class, 'delete']);
    Route::get('/provider-photo/{provider_id}/update/{id}', [ProviderPhotoGalleryC::class, 'index']);
    Route::post('/prophoto/update/{id}', [ProviderPhotoGalleryC::class, 'update']);

    Route::get('/provider-video/{provider_id}', [ProviderVideoGalleryC::class, 'index']);
    Route::post('/provideo/store/', [ProviderVideoGalleryC::class, 'store']);
    Route::get('/provideo/delete/{id}', [ProviderVideoGalleryC::class, 'delete']);
    Route::get('/provider-video/{provider_id}/update/{id}', [ProviderVideoGalleryC::class, 'index']);
    Route::post('/provideo/update/{id}', [ProviderVideoGalleryC::class, 'update']);

    Route::get('/get-provider/', [ScholarshipC::class, 'getProvider']);
    Route::get('/get-spc-by-cat/', [SpecializationC::class, 'getSpcByCat']);

    Route::prefix('/scholarship')->group(function () {

      Route::get('', [ScholarshipC::class, 'index']);
      Route::post('/store/', [ScholarshipC::class, 'store']);
      Route::get('/delete/{id}', [ScholarshipC::class, 'delete']);
      Route::get('/update/{id}', [ScholarshipC::class, 'index']);
      Route::post('/update/{id}', [ScholarshipC::class, 'update']);

      Route::prefix('/level')->group(function () {
        Route::get('/{s_id}', [ScholarshipLevelC::class, 'index']);
        Route::post('/store/', [ScholarshipLevelC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipLevelC::class, 'delete']);
        Route::get('/{s_id}/update/{id}', [ScholarshipLevelC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipLevelC::class, 'update']);
      });

      Route::prefix('/subject')->group(function () {
        Route::get('/{s_id}', [ScholarshipSubjectC::class, 'index']);
        Route::post('/store/', [ScholarshipSubjectC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipSubjectC::class, 'delete']);
        Route::get('/{s_id}/update/{id}', [ScholarshipSubjectC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipSubjectC::class, 'update']);
      });

      Route::prefix('/categories')->group(function () {
        Route::get('/{s_id}', [ScholarshipSubjectC::class, 'index']);
        Route::post('/store/', [ScholarshipSubjectC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipSubjectC::class, 'delete']);
        Route::get('/{s_id}/update/{id}', [ScholarshipSubjectC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipSubjectC::class, 'update']);
      });

      Route::prefix('/eligibility')->group(function () {
        Route::get('/{s_id}', [ScholarshipEligibilityC::class, 'index']);
        Route::post('/store/', [ScholarshipEligibilityC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipEligibilityC::class, 'delete']);
        Route::get('/{s_id}/update/{id}', [ScholarshipEligibilityC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipEligibilityC::class, 'update']);
      });

      Route::prefix('/custom-eligibility')->group(function () {
        Route::get('/{s_id}', [ScholarshipCustomEligibilityC::class, 'index']);
        Route::post('/store/', [ScholarshipCustomEligibilityC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipCustomEligibilityC::class, 'delete']);
        Route::get('/{s_id}/update/{id}', [ScholarshipCustomEligibilityC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipCustomEligibilityC::class, 'update']);
      });

      Route::prefix('/content')->group(function () {
        Route::get('', [ScholarshipContentC::class, 'index']);
        Route::post('/store/', [ScholarshipContentC::class, 'store']);
        Route::get('/delete/{id}', [ScholarshipContentC::class, 'delete']);
        Route::get('/update/{id}', [ScholarshipContentC::class, 'index']);
        Route::post('/update/{id}', [ScholarshipContentC::class, 'update']);
      });
    });
    Route::prefix('/external-scholarship')->group(function () {
      Route::get('', [ExternalScholarshipC::class, 'index']);
      Route::get('/request', [ExternalScholarshipC::class, 'request']);
      Route::post('/store/', [ExternalScholarshipC::class, 'store']);
      Route::get('/delete/{id}', [ExternalScholarshipC::class, 'delete']);
      Route::get('/update/{id}', [ExternalScholarshipC::class, 'index']);
      Route::post('/update/{id}', [ExternalScholarshipC::class, 'update']);
      Route::get('/post/{id}', [ExternalScholarshipC::class, 'request']);
      Route::post('/post/{id}', [ExternalScholarshipC::class, 'post']);
    });
    Route::prefix('/event')->group(function () {
      Route::get('', [EventC::class, 'index']);
      Route::post('/store', [EventC::class, 'store']);
      Route::get('/delete/{id}', [EventC::class, 'delete']);
      Route::get('/update/{id}', [EventC::class, 'index']);
      Route::post('/update/{id}', [EventC::class, 'update']);
    });
    Route::prefix('/service')->group(function () {
      Route::get('', [ServicesC::class, 'index']);
      Route::post('/store', [ServicesC::class, 'store']);
      Route::get('/delete/{id}', [ServicesC::class, 'delete']);
      Route::get('/update/{id}', [ServicesC::class, 'index']);
      Route::post('/update/{id}', [ServicesC::class, 'update']);
    });
    Route::prefix('/blog')->group(function () {
      Route::get('', [BlogC::class, 'index']);
      Route::post('/store', [BlogC::class, 'store']);
      Route::get('/delete/{id}', [BlogC::class, 'delete']);
      Route::get('/update/{id}', [BlogC::class, 'index']);
      Route::post('/update/{id}', [BlogC::class, 'update']);
    });
    Route::prefix('/blog-category')->group(function () {
      Route::get('', [BlogCategoryC::class, 'index']);
      Route::post('/store', [BlogCategoryC::class, 'store']);
      Route::get('/delete/{id}', [BlogCategoryC::class, 'delete']);
      Route::get('/update/{id}', [BlogCategoryC::class, 'index']);
      Route::post('/update/{id}', [BlogCategoryC::class, 'update']);
    });
    Route::prefix('/inquiry')->group(function () {
      Route::prefix('/contact-us')->group(function () {
        Route::get('/', [InquiryC::class, 'contctUs']);
        Route::get('/delete/{id}', [InquiryC::class, 'deleteContctUs']);
      });
    });
    Route::prefix('/testimonial')->group(function () {
      Route::get('', [TestimonialC::class, 'index']);
      Route::post('/store', [TestimonialC::class, 'store']);
      Route::get('/delete/{id}', [TestimonialC::class, 'delete']);
      Route::get('/update/{id}', [TestimonialC::class, 'index']);
      Route::post('/update/{id}', [TestimonialC::class, 'update']);
    });
    Route::prefix('/exam-schedule')->group(function () {
      Route::get('', [ExamDateScheduleC::class, 'index']);
      Route::post('/store', [ExamDateScheduleC::class, 'store']);
      Route::get('/delete/{id}', [ExamDateScheduleC::class, 'delete']);
      Route::get('/update/{id}', [ExamDateScheduleC::class, 'index']);
      Route::post('/update/{id}', [ExamDateScheduleC::class, 'update']);
    });
    Route::prefix('/lead-type')->group(function () {
      Route::get('', [LeadTypeC::class, 'index']);
      Route::post('/store', [LeadTypeC::class, 'store']);
      Route::get('/delete/{id}', [LeadTypeC::class, 'delete']);
      Route::get('/update/{id}', [LeadTypeC::class, 'index']);
      Route::post('/update/{id}', [LeadTypeC::class, 'update']);
    });
    Route::prefix('/lead-status')->group(function () {
      Route::get('', [LeadStatusC::class, 'index']);
      Route::post('/store', [LeadStatusC::class, 'store']);
      Route::get('/delete/{id}', [LeadStatusC::class, 'delete']);
      Route::get('/update/{id}', [LeadStatusC::class, 'index']);
      Route::post('/update/{id}', [LeadStatusC::class, 'update']);
    });
    Route::prefix('/lead-sub-status')->group(function () {
      Route::get('', [LeadSubStatusC::class, 'index']);
      Route::post('/store', [LeadSubStatusC::class, 'store']);
      Route::get('/delete/{id}', [LeadSubStatusC::class, 'delete']);
      Route::get('/update/{id}', [LeadSubStatusC::class, 'index']);
      Route::post('/update/{id}', [LeadSubStatusC::class, 'update']);
    });
    Route::prefix('/follow-up-type')->group(function () {
      Route::get('', [FollowUpTypeC::class, 'index']);
      Route::post('/store', [FollowUpTypeC::class, 'store']);
      Route::get('/delete/{id}', [FollowUpTypeC::class, 'delete']);
      Route::get('/update/{id}', [FollowUpTypeC::class, 'index']);
      Route::post('/update/{id}', [FollowUpTypeC::class, 'update']);
    });
    Route::prefix('/follow-up-status')->group(function () {
      Route::get('', [FollowUpStatusC::class, 'index']);
      Route::post('/store', [FollowUpStatusC::class, 'store']);
      Route::get('/delete/{id}', [FollowUpStatusC::class, 'delete']);
      Route::get('/update/{id}', [FollowUpStatusC::class, 'index']);
      Route::post('/update/{id}', [FollowUpStatusC::class, 'update']);
    });

    Route::prefix('/students')->group(function () {
      Route::get('', [StudentC::class, 'index']);
      Route::get('/{slug}', [StudentC::class, 'index']);
    });
    Route::get('student-trash', [StudentC::class, 'trash']);
    Route::prefix('/student')->group(function () {
      Route::get('/add', [StudentC::class, 'add']);
      Route::get('/trash', [StudentC::class, 'trash']);
      Route::post('/store/', [StudentC::class, 'store']);
      Route::post('/import', [StudentC::class, 'import']);
      Route::get('/delete/{id}', [StudentC::class, 'delete']);
      Route::get('/force-delete/{id}', [StudentC::class, 'forceDelete']);
      Route::get('/update/{id}', [StudentC::class, 'index']);
      Route::post('/update/{id}', [StudentC::class, 'update']);
      Route::get('/bulk-delete', [StudentC::class, 'bulkDelete']);
      Route::get('/bulk-force-delete', [StudentC::class, 'bulkForceDelete']);
      Route::get('/bulk-restore', [StudentC::class, 'bulkRestore']);
    });
    Route::prefix('/student/profile/{id}')->group(function () {
      Route::get('', [StudentProfileC::class, 'index']);
    });
    Route::get('/add-student-follow-up', [StudentFollowUpC::class, 'addFollowup']);
    Route::get('/get-last-follow-up', [StudentFollowUpC::class, 'getLastFollowUp']);
    Route::get('/get-all-follow-up', [StudentFollowUpC::class, 'getAllFollowUp']);

    Route::prefix('/applications')->group(function () {
      Route::get('', [ApplicationsC::class, 'index']);
      Route::post('/submit-payment', [ApplicationsC::class, 'submitPayment']);
      Route::get('/view-payment-detail', [ApplicationsC::class, 'viewPayment']);
      Route::get('/update-payment-status', [ApplicationsC::class, 'updatePaymentStatus']);
      Route::get('/bulk-delete', [ApplicationsC::class, 'bulkDelete']);
    });

    Route::prefix('/employees')->group(function () {
      Route::get('', [CreateUserC::class, 'index']);
      Route::post('/store', [CreateUserC::class, 'store']);
      Route::get('/delete/{id}', [CreateUserC::class, 'delete']);
      Route::get('/update/{id}', [CreateUserC::class, 'index']);
      Route::post('/update/{id}', [CreateUserC::class, 'update']);
    });

    Route::get('/expired-exams', [CreateExamsC::class, 'expiredExams']);
    Route::prefix('/exams')->group(function () {
      Route::get('/create', [CreateExamsC::class, 'index']);
      Route::post('/store', [CreateExamsC::class, 'store']);
      Route::get('/delete/{id}', [CreateExamsC::class, 'delete']);
      Route::get('/update/{id}', [CreateExamsC::class, 'index']);
      Route::post('/update/{id}', [CreateExamsC::class, 'update']);
    });
    Route::prefix('/exam-question')->group(function () {
      Route::post('/import', [ExamQuestionsC::class, 'Import']);
      Route::get('/export/{exam_id}', [ExamQuestionsC::class, 'Export']);
      Route::get('/{exam_id}', [ExamQuestionsC::class, 'index']);
      Route::post('/{exam_id}/store', [ExamQuestionsC::class, 'store']);
      Route::get('/delete/{id}', [ExamQuestionsC::class, 'delete']);
      Route::get('/{exam_id}/update/{id}', [ExamQuestionsC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamQuestionsC::class, 'update']);
    });
    Route::prefix('/exam-instruction')->group(function () {
      Route::get('/{exam_id}', [ExamInstructionC::class, 'index']);
      Route::post('/{exam_id}/store', [ExamInstructionC::class, 'store']);
      Route::get('/delete/{id}', [ExamInstructionC::class, 'delete']);
      Route::get('/{exam_id}/update/{id}', [ExamInstructionC::class, 'index']);
      Route::post('/{exam_id}/update/{id}', [ExamInstructionC::class, 'update']);
    });
    Route::prefix('/subjects')->group(function () {
      Route::get('/create', [ExamSubjectsC::class, 'index']);
      Route::post('/store', [ExamSubjectsC::class, 'store']);
      Route::get('/delete/{id}', [ExamSubjectsC::class, 'delete']);
      Route::get('/update/{id}', [ExamSubjectsC::class, 'index']);
      Route::post('/update/{id}', [ExamSubjectsC::class, 'update']);
    });
  });
});

/* EMPLOYEE ROUTES BEFORE LOGIN */
Route::middleware([EmployeeLoggedOut::class])->group(function () {
  Route::prefix('employee')->group(function () {
    Route::get('/login', [EmpLoginC::class, 'index']);
    Route::post('/login', [EmpLoginC::class, 'login']);
  });
});

/* EMPLOYEE ROUTES AFTER LOGIN */
Route::middleware([EmployeeLoggedIn::class])->group(function () {
  Route::get('/employee/logout/', function () {
    session()->forget('userLoggedIn');
    return redirect('employee/login');
  });
  Route::prefix('/employee')->group(function () {
    Route::get('/', [EmpDashboardC::class, 'index']);
    Route::get('/dashboard', [EmpDashboardC::class, 'index']);
    Route::get('/profile', [EmpDashboardC::class, 'profile']);
    Route::post('/update-profile', [EmpDashboardC::class, 'updateProfile']);
    Route::prefix('/students')->group(function () {
      Route::get('', [EmpStudentC::class, 'index']);
      Route::get('/{slug}', [EmpStudentC::class, 'index']);
    });
    Route::get('student-trash', [EmpStudentC::class, 'trash']);
    Route::prefix('/student')->group(function () {
      Route::get('/delete/{id}', [StudentC::class, 'delete']);
      Route::get('/force-delete/{id}', [StudentC::class, 'forceDelete']);
      Route::get('/bulk-delete', [StudentC::class, 'bulkDelete']);
    });
    Route::prefix('/applications')->group(function () {
      Route::get('', [ApplicationsC::class, 'index']);
      Route::post('/submit-payment', [ApplicationsC::class, 'submitPayment']);
      Route::get('/view-payment-detail', [ApplicationsC::class, 'viewPayment']);
      Route::get('/update-payment-status', [ApplicationsC::class, 'updatePaymentStatus']);
      Route::get('/bulk-delete', [ApplicationsC::class, 'bulkDelete']);
    });
  });
});

Route::prefix('common')->group(function () {
  Route::get('/get-spc-by-cat', [CommonController::class, 'getSpcByCat']);
  Route::get('/change-status', [CommonController::class, 'changeStatus']);
  Route::get('/', [CommonController::class, 'updateField']);
  Route::get('/update-field', [CommonController::class, 'updateFieldById']);
  Route::get('/get-lead-sub-status-by-status', [CommonController::class, 'getSubStatusByStatus']);
  Route::get('/add-student-follow-up', [StudentFollowUpC::class, 'addFollowup']);
  Route::get('/get-last-follow-up', [StudentFollowUpC::class, 'getLastFollowUp']);
  Route::get('/get-all-follow-up', [StudentFollowUpC::class, 'getAllFollowUp']);
  Route::get('/asign-leads', [StudentFollowUpC::class, 'asignLeads']);
  Route::get('/unasign-leads', [StudentFollowUpC::class, 'unAsignLeads']);
});
