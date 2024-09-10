<?php

namespace App\Repositories;

use App\Models\admlogin;
use App\Models\app_user;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

/**
 * Class admloginRepository
 * @package App\Repositories
 * @version January 23, 2020, 6:23 am UTC
*/

class admloginRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'type',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return admlogin::class;
    }

    // Function to store data in both admlogin and app_user tables
    public function CreateAppUser($admloginData,$type)
    {
        DB::beginTransaction();
        try {
            $admloginData['type'] = $type;   
            // Store data in app_user table
            $appUser = app_user::create($admloginData);

            DB::commit();
            return [ 'app_user' => $appUser];
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
