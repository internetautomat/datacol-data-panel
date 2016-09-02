<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct( UserRepository $userRepo )
    {
        $this->userRepository = $userRepo;
    }

    public function impersonate( $id )
    {
        $user = User::find( $id );

        // Guard against administrator impersonate
        if ( auth()->user()->can( 'users.manage' ) )
        {
            auth()->user()->setImpersonating( $user->id );
            return redirect()->route( 'profile.index' );
        }
        else
        {
            flash()->error( t( 'impersonate.flash.cannot' ) );
        }

        return redirect()->back();
    }

    public function stopImpersonate()
    {
        auth()->user()->stopImpersonating();
        flash()->success( t( 'impersonate.flash.stopped' ) );
        return redirect()->back();
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index( Request $request )
    {
        $this->authorize( 'users.view' );
        $this->userRepository->pushCriteria( new RequestCriteria( $request ) );
        $users = $this->userRepository->paginate( 50 );

        return view( 'users.index' )
            ->with( 'users', $users );
    }

    public function create()
    {
        $this->authorize( 'users.manage' );
        return view( 'users.create' );
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store( CreateUserRequest $request )
    {
        $this->authorize( 'users.manage' );
        $input = $request->all();
        if ( !empty( $input[ 'password' ] ) )
        {
            $input[ 'password' ] = bcrypt( $input[ 'password' ] );
        }
        else
        {
            unset( $input[ 'password' ] );
        }

        $user = $this->userRepository->create( $input );
        $user->roles()->sync( [ $request->get( 'role' ) ] );

        Flash::success( 'User saved successfully.' );

        return redirect( route( 'users.index' ) );
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $this->authorize( 'users.view' );
        $user = $this->userRepository->findWithoutFail( $id );

        if ( empty( $user ) )
        {
            Flash::error( 'User not found' );

            return redirect( route( 'users.index' ) );
        }

        return view( 'users.show' )->with( 'user', $user );
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $this->authorize( 'users.manage' );
        $user = $this->userRepository->findWithoutFail( $id );

        if ( empty( $user ) )
        {
            Flash::error( 'User not found' );

            return redirect( route( 'users.index' ) );
        }


        return view( 'users.edit' )->with( [ 'user' => $user ] );
    }


    /**
     * Update the specified User in storage.
     *
     * @param  int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update( $id, UpdateUserRequest $request )
    {
        $this->authorize( 'users.manage' );

        $user = $this->userRepository->findWithoutFail( $id );


        if ( empty( $user ) )
        {
            Flash::error( 'User not found' );

            return redirect( route( 'users.index' ) );
        }


        $input = $request->all();
        if ( !empty( $input[ 'password' ] ) )
        {
            $input[ 'password' ] = bcrypt( $input[ 'password' ] );
        }
        else
        {
            unset( $input[ 'password' ] );
        }


        $user = $this->userRepository->update( $input, $id );

        $user->roles()->sync( [ $request->get( 'role' ) ] );


        Flash::success( 'User updated successfully.' );

        return redirect( route( 'users.index' ) );
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        $this->authorize( 'users.manage' );
        $user = $this->userRepository->findWithoutFail( $id );

        if ( empty( $user ) )
        {
            Flash::error( 'User not found' );

            return redirect( route( 'users.index' ) );
        }

        $this->userRepository->delete( $id );

        Flash::success( 'User deleted successfully.' );

        return redirect( route( 'users.index' ) );
    }
}
