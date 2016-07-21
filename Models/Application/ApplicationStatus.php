<?php namespace App\Modules\Tenant\Models\Application;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class ApplicationStatus extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_status';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'application_status_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_application_id', 'status_id', 'date_applied', 'date_removed', 'active'];

    /**
     * Disable default timestamp feature.
     *
     * @var boolean
     */
    public $timestamps = false;

        function application_create(array $request, $course_application_id)
        {
           DB::beginTransaction();

          try {
                
                $status = ApplicationStatus::where('course_application_id', $course_application_id)->first();
                if(!$status)
                {
                 $status = ApplicationStatus::create([
                    'course_application_id' => $course_application_id,
                    'status_id'             => 2,
                    'date_applied'          => Carbon::now()
                    ]); 
                }
               // $status = ApplicationStatus::create([
               //      'course_application_id' => $course_application_id,
               //      'status_id'             => 2,
               //      'date_applied'          => Carbon::now()
               //      ]);
           

               DB::commit();
              return true;
               // all good
           } catch (\Exception $e) {
               DB::rollback();
              //return false;
              dd($e);
              // something went wrong
          }
         }





}