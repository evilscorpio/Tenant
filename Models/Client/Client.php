<?php namespace App\Modules\Tenant\Models\Client;

use App\Modules\Tenant\Models\Person\PersonPhone;
use App\Modules\Tenant\Models\Phone;
use App\Modules\Tenant\Models\User;
use App\Modules\Tenant\Models\Address;
use App\Modules\Tenant\Models\Person\Person;
use App\Modules\Tenant\Models\Person\PersonAddress;
use Illuminate\Database\Eloquent\Model;
use DB;

class Client extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'client_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['added_by', 'user_id', 'person_id', 'description','referred_by'];

    /**
     * Get the person record associated with the client.
     */
    public function person()
    {
        return $this->belongsTo('App\Modules\Tenant\Models\Person\Person');
    }

    /**
     * Get the user record associated with the client.
     */
    public function user()
    {
        return $this->belongsTo('App\Modules\Tenant\Models\User');
    }


    /*
     * Add client info
     * Output client id
     */
    function add(array $request)
    {
        DB::beginTransaction();

        try {
            // Saving client profile
            $person = Person::create([
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'dob' => insert_dateformat($request['dob']),
                'sex' => $request['sex'],
                'passport_no' => $request['passport_no']
            ]);

            $user = User::create([
                'email' => $request['email'],
                'role' => 0, // 0 : client, 1 : admin, 2 : super-admin
                'status' => 0, // Pending
                'person_id' => $person->person_id, // pending
            ]);

            $client = Client::create([
                'user_id' => $user->user_id,
                'person_id' => $person->person_id,
                'added_by' => current_tenant_id(),
                'referred_by'=>$request['referred_by'],
                'description'=>$request['description'],
            ]);

            // Add address
            $address = Address::create([
                'street' => $request['street'],
                'suburb' => $request['suburb'],
                'postcode' => $request['postcode'],
                'state' => $request['state'],
                'country_id' => $request['country_id'],
            ]);

            PersonAddress::create([
                'address_id' => $address->address_id,
                'person_id' => $person->person_id,
                'is_current' => 1
            ]);

            // Add Phone Number
            $phone = new Phone();
            $phone_id = $phone->add($request['number']);
            PersonPhone::create([
                'phone_id' => $phone_id,
                'person_id' => $person->person_id,
                'is_primary' => 1
            ]);

            DB::commit();
            return $client->client_id;
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // something went wrong
        }
    }

    /*
     * Update client info
     * Output boolean
     */
    function edit(array $request, $client_id)
    {
        DB::beginTransaction();

        try {

            $client = Client::find($client_id);
            $client->referred_by = $request['referred_by'];
            $client->description = $request['description'];
            $client->save();
            // Saving client profile
            $person = Person::find($client->person_id);
            $person->first_name = $request['first_name'];
            $person->middle_name = $request['middle_name'];
            $person->last_name = $request['last_name'];
            $person->dob = insert_dateformat($request['dob']);
            $person->sex = $request['sex'];
            $person->passport_no = $request['passport_no'];
            $person->save();

            $user = User::find($client->user_id);
            $user->email = $request['email'];
            $user->save();

            $person_address = PersonAddress::where('person_id', $client->person_id)->first();
            $address = Address::find($person_address->address_id);

            // Edit address
            $address->street = $request['street'];
            $address->suburb = $request['suburb'];
            $address->postcode = $request['postcode'];
            $address->state = $request['state'];
            $address->country_id = $request['country_id'];
            $address->save();

            $person_phone = PersonPhone::where('person_id', $client->person_id)->first();
            $phone = Phone::find($person_phone->phone_id);

            // Edit phone
            $phone->number = $request['number'];
            $phone->save();

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

    /*
     * Update client info
     * Output Response
     */
    function getDetails($client_id)
    {
        $client = Client::leftJoin('persons', 'persons.person_id', '=', 'clients.person_id')
            ->leftJoin('person_addresses', 'person_addresses.person_id', '=', 'persons.person_id')
            ->leftJoin('addresses', 'addresses.address_id', '=', 'person_addresses.address_id')
            ->leftJoin('person_phones', 'person_phones.person_id', '=', 'persons.person_id')
            ->leftJoin('phones', 'phones.phone_id', '=', 'person_phones.phone_id')
            ->leftJoin('users', 'users.user_id', '=', 'clients.user_id')
            ->where('clients.client_id', $client_id) //and user for email?
            ->first(); //dd($client->toArray());
        return $client;
    }
}
