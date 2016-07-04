<?php namespace App\Modules\Tenant\Models\Client;
use App\Modules\Tenant\Models\Notes;
use Illuminate\Database\Eloquent\Model;
use DB;


class ApplicationNotes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_notes';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['application_id', 'note_id'];

    public $timestamps = false;

     public function notes()
    {
        return $this->belongsTo('App\Modules\Tenant\Models\Notes');
    }


    public function getApplicationNotes($application_id)
    {
    $application_notes = Notes::orderBy('notes_id', 'desc')->get();
        return $application_notes;
    }

    public function uploadApplicationNotes($application_id, array $request)
    {
        $notes = Notes::create([  
                'added_by_user_id' => current_tenant_id(),      
                'description' => $request['description'],                
                'remind' => (isset($request['remind']))? 1 : 0,              
                'reminder_date' => $request['reminder_date'],
            ]);

        $application_notes = ApplicationNotes::create([ 
                'application_id' => $application_id, 
                'note_id' => $notes->notes_id      
                
            ]);
    }

   public function deleteApplicationNote($note_id)
    {
        Notes::destroy($note_id);
     $application_notes= ApplicationNotes::where('note_id', $note_id)->first()->delete();
         if(!empty($application_notes))
            return $application_notes->application_id;
        else
            dd('Somthing went wrong');
    }


}
