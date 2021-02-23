<?php

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

// Route::get('/', function () {
    //     return view('admintoffer.index');
    // });
    Route::get('agent/payment/{student_id}/{amount}', 'PaymentController@index')->name('payment');
Route::post('agent/paysuccess', 'PaymentController@razorPaySuccess');
Route::get('agent/razor-thank-you/{id}', 'PaymentController@RazorThankYou');
    Route::get('/', 'AdmitOfferController@index')->name('home');
    Route::get('/aboutus', 'AdmitOfferController@aboutus')->name('aboutus');
    Route::get('/privacy_policy', 'AdmitOfferController@privacyPolicy')->name('privacy_policy');
    Route::get('/refund_policy', 'AdmitOfferController@refundPolicy')->name('refund_policy');
    Route::get('/termsandconditions', 'AdmitOfferController@termsandconditions')->name('termsandconditions');
    Route::get('/solution', 'AdmitOfferController@solution')->name('solution');
    Route::get('/gallery', 'AdmitOfferController@gallery')->name('gallery');
    Route::get('/contactus', 'AdmitOfferController@contactus')->name('contactus');
    Route::get('/webinars', 'AdmitOfferController@webinars')->name('webinars');
    //notification
    Route::get('admin/notification','NotificationController@getNotifications')->name('get.notifications');
    Route::get('admin/chat/edit/{id}/{agent_id}','ChatController@edit')->name('chat.edit');
    Route::post('admin/chat/store','ChatController@store')->name('chat.store');
    Route::post('admin/student/chat/store','ChatController@StudentChatstore')->name('student.chat.store');
    Route::get('/design', function () {
        return view('design');
    });
    // student chat
    Route::get('admin/student/chat/edit/{id}/{student}','ChatController@Studentedit')->name('student.chat.edit');
    
    
Auth::routes();
Route::get('/page/lock', 'AdmitOfferController@lock')->name('pagelock.create');
Route::post('/page/lock', 'AdmitOfferController@unlock')->name('pagelock.store');
Route::get('/page/lock/changepassword', 'AdmitOfferController@changePassword')->name('pagelocker.changepassword');
Route::POST('/page/lock/changepassword', 'AdmitOfferController@changePasswordUpdate')->name('pagelocker.changePasswordUpdate');

Route::get('/home', 'HomeController@index');
Route::get('/pdf/view', 'AdmitOfferController@getpdfView')->name('pdf.views');
Route::post('/pdf/view', 'AdmitOfferController@pdfView')->name('pdf.view');
Route::get('institute/{id}', 'CollegeController@instituteDeactivate')->name('institute.Deactivate');
Route::get('admin/getState/{id}', 'LocationController@getState')->name('admin.getState');
Route::get('admin/getCity/{id}', 'LocationController@getCity')->name('admin.getCity');
Route::group(['prefix'=>'admin','middleware'=> 'auth:admin'],function(){

    // countries
    Route::get('/country/list', 'LocationController@countryList')->name('admin.country.list');
    Route::get('/addCountry', 'LocationController@addCountry')->name('admin.addCountry');
    Route::POST('/addCountry', 'LocationController@saveCountry')->name('admin.saveCountry');
    Route::delete('/country/delete/{id}', 'LocationController@countryDelete')->name('admin.country.delete');
    Route::get('/country/edit/{id}', 'LocationController@countryEdit')->name('admin.country.edit');
    Route::patch('/country/edit/{id}', 'LocationController@countryUpdate')->name('admin.country.Update');
    
    // states
    Route::get('/states/list', 'LocationController@statesList')->name('admin.state.list');
    Route::get('/addState', 'LocationController@addState')->name('admin.addState');
    Route::POST('/addState', 'LocationController@saveState')->name('admin.saveState');
    Route::delete('/state/delete/{id}', 'LocationController@stateDelete')->name('admin.state.delete');
    Route::get('/state/edit/{id}', 'LocationController@stateEdit')->name('admin.state.edit');
    Route::patch('/state/edit/{id}', 'LocationController@stateUpdate')->name('admin.state.Update');
    // cities
    Route::get('/cities/list', 'LocationController@citiesList')->name('admin.city.list');
    Route::get('/addCity', 'LocationController@addCity')->name('admin.addCity');
    Route::POST('/addCity', 'LocationController@saveCity')->name('admin.saveCity');
    Route::delete('/city/delete/{id}', 'LocationController@cityDelete')->name('admin.city.delete');
    Route::get('/city/edit/{id}', 'LocationController@cityEdit')->name('admin.city.edit');
    Route::patch('/city/edit/{id}', 'LocationController@cityUpdate')->name('admin.city.Update');
    
    Route::get('/qualificationDoc/accepted/{id}', 'admin\AppliedStudentFileController@updateAcceptStatus')->name('qualificationDoc.accepted');
    Route::get('/qualificationDoc/rejected/{id}', 'admin\AppliedStudentFileController@updateRejectStatus')->name('qualificationDoc.rejected');
   
    // allow agent country
    Route::resource('/allow/country', 'admin\AllowCountryAgentController');

    Route::get('/sop/accepted/{id}','SoppendencyController@updateAcceptStatus')->name('sop.accepted');
    Route::post('/sop/rejected/{id}','SoppendencyController@updateRejectStatus')->name('sop.rejected');

    // task Manager
    Route::resource('taskmanager', 'admin\TaskManagerController');
    Route::get('alltaskmanagers', 'admin\TaskManagerController@adminindex')->name('taskmanager.mainList');
    Route::POST('/saveComment', 'admin\AppliedStudentFileController@updateStudentComment')->name('student.comment');
    // commission
    Route::resource('commission', 'admin\CommissionController')->except('commission.create');
    Route::get('commission/create/{id}', 'admin\CommissionController@create')->name('commission.create');
    Route::get('entry/requirements', 'admin\CommissionController@createentryrequirement')->name('entry.requirements.get');
    Route::post('entry/requirements/store', 'admin\CommissionController@requirementsStore')->name('requirements.store');
    
    // colleges
    Route::resource('colleges', 'CollegeController');
    Route::get('/colleges/getAllUniversity/{id}','CollegeController@getAllUniversities');
    // courses
    Route::resource('university', 'admin\UniversityController');
    // courses
    Route::get('/courses/{id}', 'CoursesController@index')->name('courses.index');
    Route::get('/courses/create/{id}', 'CoursesController@create')->name('courses.create');
    Route::POST('/courses/store/', 'CoursesController@store')->name('courses.store');
    Route::delete('/courses/destroy/{id}', 'CoursesController@destroy')->name('courses.destroy');
    Route::get('/courses/edit/{id}', 'CoursesController@edit')->name('courses.edit');
    Route::get('/courses/show/{id}', 'CoursesController@show')->name('courses.show');
    Route::post('/courses/update/{id}', 'CoursesController@update')->name('courses.update');
    Route::post('/courses/excl/import', 'CoursesController@importCourse')->name('courses.importCourse');
    Route::post('/courses/verify', 'CoursesController@CourseVerify')->name('courses.verify');
    
    // qualification
    Route::resource('qualification', 'QualificationController');
    
    // instituteTypes
    Route::resource('instituteTypes', 'InstituteTypeController');
    // announcement
    Route::resource('announcement', 'AnnouncementController');

    // programLength
    Route::resource('programLength', 'ProgramLengthController');

    // SchoolType
    Route::resource('schoolType', 'SchoolTypeController');
    // Course level
    Route::resource('courseLevel', 'CourseLevelController');
    // Subjects
    Route::resource('subjects', 'SubjectController');
    // Ilets Score
    Route::resource('iletsScore', 'IletsScoreController');
    // English Score
    Route::resource('englishScore', 'EnglishScoreController');
    // Admin Agets
    Route::resource('agents', 'admin\AgentController');
    Route::get('myagent/delete/{id}', 'admin\AgentController@deleteAgent');
    Route::get('aprve/{id}', 'admin\AgentController@ApproveAgent')->name('agent.approve');
    Route::get('disaprve/{id}', 'admin\AgentController@DisapproveAgent')->name('agent.disapprove');
    // Intake Agets
    Route::resource('intakes', 'IntakeController');
    // Intake Agets
    Route::resource('englishTest', 'EnglishTestController');
    // Student Qualification Grade
    Route::resource('studentQualificationGrades', 'QualificationGradeController');
    // Student qualificationBoard
    Route::resource('qualificationBoard', 'QualificationBoardController');
    // Student Qualification Level Grade
    Route::resource('studentQualificationLevelGrades', 'QualificationLevelGradeController');
    // Student Questions 
    Route::resource('studentQuestions', 'StudentQuestionController');
    // Questions
    Route::resource('Questions', 'QuestionController');
    // Student Questions Grade
    Route::resource('qualificationTotals', 'StudentQualificationTotalController');
    // Program Title
    Route::resource('programTitle', 'admin\ProgramTitleController');
    // Math Score
    Route::resource('mathScore', 'admin\MathScoreController');
    // TeamPreProcess Score
    Route::resource('teamPreProcess', 'admin\TeamPreProcessController');
    // previousQualification 
    Route::resource('previousQualification', 'PreviousQualificationController');
    // Chat
    Route::get('chat/{id}', 'ChatController@show')->name('chat.show');
    Route::get('chat/student/{id}', 'ChatController@studentChat')->name('chat.student.show');
    Route::get('chats/create/{id}', 'ChatController@create')->name('chat.create');
    
    Route::get('student/chat/{id}', 'ChatController@AdminStudentChat')->name('admin.student.chat');

    Route::get('course/activate/{id}', 'CoursesController@activate')->name('course.activate');
    Route::get('course/deactivate/{id}', 'CoursesController@deactivate')->name('course.deactivate');
    
    Route::post('/application/rejection', 'admin\ApplicationDocumentController@ApplicationRejection')->name('application.rejection');
   
    // Files Agets 
    Route::get('application/getChangeCourses/{intake_id}/{institute_id}', 'admin\ApplicationController@getCourses')->name('application.getCourses');
    Route::post('getChangeCourses', 'admin\ApplicationController@UpdateChangeCourses')->name('application.UpdateCourses');
    Route::resource('/studentfiles','admin\AppliedStudentFileController');
    Route::get('/application/shortlists','admin\AppliedStudentFileController@Shortlist')->name('application.Shortlist');
    Route::get('today/student/shortlists','admin\AppliedStudentFileController@TodayShortlist')->name('today.application.Shortlist');
    Route::get('total/student/shortlists','admin\AppliedStudentFileController@TotalShortlist')->name('total.application.Shortlist');
    Route::get('today/application','admin\AppliedStudentFileController@todayApplication')->name('today.application');
    Route::get('/pendingFinalSubmit','admin\AppliedStudentFileController@pendingFinalSubmit')->name('pending.final.submit');
    Route::resource('/application','admin\ApplicationController');
    Route::get('/application/status/{id}','admin\ApplicationController@statusApplications')->name('status.applicatons.list');
    Route::get('/pending/application','admin\ApplicationController@pendingApplications')->name('admin.pending.applications');
    Route::get('/pendencies/application','admin\AppliedStudentFileController@pendenciesApplications')->name('admin.pendencies.applications');
    Route::get('/applications/applyToUni/today','admin\ApplicationController@todayAppltToUni')->name('application.today.applyToUni');
    Route::resource('/applicationStatus','admin\ApplicationStatusController');
    Route::post('/applications','admin\ApplicationController@updateApplicationStatus')->name('applications.Status');
    Route::resource('/pendancyAttachment','admin\PendancyAttachmentController');
    Route::get('/pendancyAttachments/{id}','admin\PendancyAttachmentController@destroy')->name('pendancyAttachments.delete');
    Route::get('/getSubject/{id}','CoursesController@getSubjects');
    
    Route::get('/getAllApplications', 'admin\AppliedStudentFileController@getApplications')->name('getapplication.index');
    Route::get('pending/getAllApplications', 'admin\AppliedStudentFileController@getpendingApplications')->name('getapplication.index');
    Route::post('/application/offerlatter', 'admin\ApplicationDocumentController@store')->name('applications.offerlatter');
    Route::post('/application/loaOfferLetter', 'admin\ApplicationDocumentController@loaOfferLetter')->name('applications.loaOfferLetter');
    
    //CAS Document
    Route::post('/application/clearCasDocument', 'admin\ApplicationDocumentController@clearCasDocument')->name('applications.clearCasDocument');
    
    //processor
    Route::POST('/processor','admin\TeamProcessController@store')->name('processor.store');

});
Route::group(['prefix'=>'search'],function(){
    Route::get('/student/add/{id}','admin\AppliedStudentFileController@addMoreProgram')->name('student.program.add');

    Route::get('/student/view/notif/{id}', 'Search\SearchController@viewStudentNotify')->name('studentview.notify')->middleware('auth:admin');
    Route::get('/courseData', 'Search\SearchController@course_data')->name('search.course.data');
    Route::get('/', 'Search\SearchController@index')->name('search.index');
    Route::post('/', 'Search\SearchController@getCourses')->name('search.course');
    Route::post('/getCourseDetail', 'Search\SearchController@getCourseDetail')->name('search.getCourseDetail');
    Route::get('/s/{country_id}', 'Search\SearchController@getCourses');
    Route::get('/countries', 'Search\SearchController@countries')->name('search.countries');
    Route::get('/applyFor/{student}/{country}/{course}/{text}', 'Agent\AppliedStudentFileController@AppliedFor')->name('apply.for');
});
Route::get('/sessionStatus/{parm}', 'Search\SearchController@SessionStatus')->name('session.status');

   // students
    Route::resource('applicant/EditStudent','Agent\StudentController')->except(['applicant.index'])->middleware('auth:student');
    Route::POST('new/student/rejected','Agent\StudentController@StudentRejectionStatus')->name('new.student.rejection');
    Route::get('new/student/shortlisting/{id}','Agent\StudentController@StudentShortlisting')->name('new.student.shortlisting');
    Route::get('applicant/AllApplication', 'Agent\StudentController@AllApplications')->name('applicant.all.Applications')->middleware('auth:student');
    Route::get('applicant/student/application/{id}','Agent\StudentController@applicationView')->name('applicant.student.application.View')->middleware('auth:student');