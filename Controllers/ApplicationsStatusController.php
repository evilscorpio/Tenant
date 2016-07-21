<?php

namespace App\Modules\Tenant\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Modules\Tenant\Models\Person\Person;
use App\Modules\Tenant\Models\Application\CourseApplication;
use App\Modules\Tenant\Models\Application\ApplicationStatus;
use App\Modules\Tenant\Models\Person\PersonPhone;
use App\Modules\Tenant\Models\User;
use App\Modules\Tenant\Models\Note;
use DB;
use Flash;

class ApplicationsStatusController extends BaseController
{
     function __construct(CourseApplication $course_application, Request $request, Note $note, ApplicationStatus $application_status)
    {
        $this->course_application = $course_application;
        $this->application_status = $application_status;
        $this->note = $note;
        $this->request = $request;
        parent::__construct();
    }
    //information for enquiry page
    public function index()
    {
        $applications = CourseApplication::leftjoin('users', 'users.user_id', '=', 'course_application.user_id')
            ->leftjoin('persons', 'persons.person_id', '=', 'users.person_id')
            ->leftjoin('person_phones', 'persons.person_id', '=', 'person_phones.person_id')
            ->leftjoin('phones', 'person_phones.phone_id', '=', 'phones.phone_id')
            ->leftjoin('institute_courses', 'institute_courses.institute_course_id', '=' , 'course_application.institution_course_id')
            ->leftjoin('courses', 'courses.course_id','=', 'institute_courses.course_id')
            ->leftjoin('institutes', 'institutes.institution_id','=', 'institute_courses.institute_id')
            ->leftjoin('companies', 'companies.company_id','=', 'institutes.company_id')
            ->leftjoin('intakes', 'intakes.intake_id', '=' , 'course_application.intake_id')
            ->select(['persons.first_name','companies.name as company', 'courses.name', 'intakes.intake_date','course_application.tuition_fee', 'course_application.course_application_id', 'phones.number','users.email'])
            ->orderBy('course_application.course_application_id', 'desc')
            ->paginate(1);

        return view('Tenant::applications/enquiry',['applications'=>$applications]);
    }

    //information for apply_offer page
 public function apply_offer($course_application_id)
    {
        $applications = CourseApplication::leftjoin('users', 'users.user_id', '=', 'course_application.user_id')
            ->leftjoin('persons', 'persons.person_id', '=', 'users.person_id')
            ->leftjoin('institute_courses', 'institute_courses.institute_course_id', '=' , 'course_application.institution_course_id')
            ->leftjoin('courses', 'courses.course_id','=', 'institute_courses.course_id')
            ->leftjoin('institutes', 'institutes.institution_id','=', 'institute_courses.institute_id')
            ->leftjoin('companies', 'companies.company_id','=', 'institutes.company_id')
            ->leftjoin('intakes', 'intakes.intake_id', '=' , 'course_application.intake_id')
            ->where('course_application.course_application_id',$course_application_id)
            ->select(['persons.first_name','companies.name as company', 'courses.name', 'intakes.intake_date','course_application.tuition_fee', 'course_application.course_application_id'])
            ->orderBy('course_application.course_application_id', 'desc')
            ->find($course_application_id);

        return view('Tenant::applications/actions/apply_offer',['applications'=>$applications]);   
    }

     //updates for apply_offer
     public function update($course_application_id)
     {

        $updated = $this->course_application->application_update($this->request->all(), $course_application_id);
         if ($updated)
            $updated = $this->application_status->application_create($this->request->all(), $course_application_id); 
              // $status = ApplicationStatus::create([
              //     'course_application_id'=> $course_application_id,
              //     'status_id'=> 2
              //     ]);
             
             Session::flash('success', 'Updated Successfully');
         return redirect()->route('applications.offer_letter_processing.index');
     }


    //information for cancel/quarantine page
     public function cancel_application($course_application_id)
    {
        $applications = CourseApplication::join('users', 'users.user_id', '=', 'course_application.user_id')
            ->leftjoin('persons', 'persons.person_id', '=', 'users.person_id')
            ->leftjoin('institute_courses', 'institute_courses.institute_course_id', '=' , 'course_application.institution_course_id')
            ->leftjoin('courses', 'courses.course_id','=', 'institute_courses.course_id')
            ->leftjoin('institutes', 'institutes.institution_id','=', 'institute_courses.institute_id')
            ->leftjoin('companies', 'companies.company_id','=', 'institutes.company_id')
            ->leftjoin('intakes', 'intakes.intake_id', '=' , 'course_application.intake_id')
            ->leftjoin('application_notes', 'course_application.course_application_id', '=' , 'application_notes.application_id')
            ->leftjoin('notes', 'application_notes.note_id', '=' , 'notes.notes_id')
            ->where('course_application.course_application_id',$course_application_id)
            ->select(['persons.first_name','companies.name as company', 'courses.name', 'intakes.intake_date','course_application.tuition_fee', 'course_application.course_application_id'])
            ->orderBy('course_application.course_application_id', 'desc')
            ->find($course_application_id);

        return view('Tenant::applications/actions/cancel_application',['applications'=>$applications]);   
    }

          //cancel/qurantine actions
          public function cancel_qurantine($notes_id)
           {
               $created = $this->note->note_create($this->request->all(), $notes_id);
               if ($created)
                   Session::flash('success', 'Quarantinded Successfully');
               return redirect()->route('applications.enquiry.index');
           }

        //information for offer letter processing
           public function offerLetterProcessing()
           {
            
            $applications = CourseApplication::leftjoin('users', 'users.user_id', '=', 'course_application.user_id')
            ->leftjoin('persons', 'persons.person_id', '=', 'users.person_id')
            ->leftjoin('person_phones', 'persons.person_id', '=', 'person_phones.person_id')
            ->leftjoin('phones', 'person_phones.phone_id', '=', 'phones.phone_id')
            ->leftjoin('institute_courses', 'institute_courses.institute_course_id', '=' , 'course_application.institution_course_id')
            ->leftjoin('courses', 'courses.course_id','=', 'institute_courses.course_id')
            ->leftjoin('institutes', 'institutes.institution_id','=', 'institute_courses.institute_id')
            ->leftjoin('companies', 'companies.company_id','=', 'institutes.company_id')
            ->leftjoin('intakes', 'intakes.intake_id', '=' , 'course_application.intake_id')
            ->join('application_status', 'application_status.course_application_id', '=', 'course_application.course_application_id')
            ->join('status', 'status.status_id', '=', 'application_status.status_id')
            ->select(['persons.first_name','companies.name as company', 'courses.name', 'intakes.intake_date','course_application.tuition_fee', 'course_application.course_application_id','status.status_id','users.email', 'phones.number'])
            ->orderBy('course_application.course_application_id', 'desc')
            ->paginate(1);
            
            return view('Tenant::applications/offer_letter_processing',compact('applications'));
           }

}