<?php

namespace App\Actions\Fortify;

use App\Models\admin\Co_UserModel;
use App\Models\ShippingDistrictModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'integer', 'min:1', 'max:2'],
            'status' => ['required', 'integer', 'min:0', 'max:1'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        if ($input['role']==2) {
            Validator::make($input, [
                'permission' => ['required', 'array'],
            ])->validate();
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'status' => $input['status'],
            'password' => Hash::make($input['password']),
        ]);

            $permission =Co_UserModel::create([
                'user_id' => $user->id,
                'permission' =>json_encode(empty($input['permission'])?[0]:$input['permission'])
            ]);
            $permission->save();



        return $user;
    }
}
