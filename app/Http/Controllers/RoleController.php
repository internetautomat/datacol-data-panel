<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct( RoleRepository $roleRepo )
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     * @return Response
     */
    public function index( Request $request )
    {
        $this->authorize( 'system.view' );
        $this->roleRepository->pushCriteria( new RequestCriteria( $request ) );
        $roles = $this->roleRepository->paginate( 50 );

        return view( 'roles.index' )
            ->with( 'roles', $roles );
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize( 'system.manage' );
        return view( 'roles.create' );
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store( CreateRoleRequest $request )
    {
        $this->authorize( 'system.manage' );
        $input = $request->all();

        $role = $this->roleRepository->create( $input );

        $role->abilities()->sync( $input[ 'abilities' ] );


        Flash::success( 'Role saved successfully.' );

        return redirect( route( 'roles.index' ) );
    }

    /**
     * Display the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $this->authorize( 'system.view' );
        $role = $this->roleRepository->findWithoutFail( $id );

        if ( empty( $role ) )
        {
            Flash::error( 'Role not found' );

            return redirect( route( 'roles.index' ) );
        }

        return view( 'roles.show' )->with( 'role', $role );
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $this->authorize( 'system.manage' );
        $role = $this->roleRepository->findWithoutFail( $id );

        if ( empty( $role ) )
        {
            Flash::error( 'Role not found' );

            return redirect( route( 'roles.index' ) );
        }

        return view( 'roles.edit' )->with( 'role', $role );
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update( $id, UpdateRoleRequest $request )
    {
        $this->authorize( 'system.manage' );
        $role = $this->roleRepository->findWithoutFail( $id );

        if ( empty( $role ) )
        {
            Flash::error( 'Role not found' );

            return redirect( route( 'roles.index' ) );
        }

        $role = $this->roleRepository->update( $request->all(), $id );

        $role->abilities()->sync( $request->get( 'abilities' ) );

        Flash::success( 'Role updated successfully.' );

        return redirect( route( 'roles.index' ) );
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        $this->authorize( 'system.manage' );
        $role = $this->roleRepository->findWithoutFail( $id );

        if ( empty( $role ) )
        {
            Flash::error( 'Role not found' );

            return redirect( route( 'roles.index' ) );
        }

        $this->roleRepository->delete( $id );

        Flash::success( 'Role deleted successfully.' );

        return redirect( route( 'roles.index' ) );
    }
}
