<?php

namespace App\Http\Requests;

class UpdateUserRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$targetUser = $this->route('user');

        //return auth()->user()->can( 'users.manage' );

        return true;
        //        $user = User::find($this->route('id'));
        //
        //        return $user->canBeEditedBy(Auth::user()) &&
        //        Auth::user()->canSetRolesOnAnotherUser($user,
        //            array_keys($this->get('roles', []))
        //        );
    }

    public function forbiddenResponse()
    {
        flash()->error( 'You are not allowed to do this' );
        return redirect()->back()->withInput();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ];
    }
}
