<?php namespace App\Modules\Tenant\Models\Timeline;

use Illuminate\Database\Eloquent\Model;
use DB;

class TimelineIcon extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timeline_icons';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'icon_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    /**
     * Disable default timestamp feature.
     *
     * @var boolean
     */
    public $timestamps = false;

}
