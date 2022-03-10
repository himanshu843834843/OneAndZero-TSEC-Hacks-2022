<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UsersService
{
    public function update(User $user, array $updateData){
        User::updateUser($user, $updateData);
    }

    public function destroy(User $user)
    {
        $user->destroyUser();
        return redirect(route('home'));
    }

    public function getUsers(?string $searchValue, array $order, int $start, int $length): JsonResponse
    {
        $users = User::search($searchValue)
            ->order($order)
            ->limitBy($start, $length)
            ->get();

        $numberOfTotalRows = User::count('*');

        if(empty($searchValue)){
            $numberOfFilteredRows = $numberOfTotalRows;
        } else {
            $numberOfFilteredRows = User::search($searchValue)
                ->count('*');
        }
        return $this->yajraData($users, $numberOfFilteredRows, $numberOfTotalRows);
    }

    /**
     * @throws Exception
     */
    private function yajraData(Collection $users,
                               int        $numberOfFilteredRows,
                               int        $numberOfTotalRows
    ): JsonResponse
    {
        return DataTables::of($users)
            ->skipPaging()
            ->addColumn('role', function ($users){
                return '<span class="label font-weight-bold label-lg badge '
                    .(($users->isAdmin()) ? 'badge-light-success' : 'badge-light-warning').' label-inline">'
                    .(($users->isAdmin())? 'ADMIN' : 'MEMBER').
                    '</span>
                        </span>';
            })

            ->addColumn('actions', function ($user){
                if($user->isAdmin()){
                    if(auth()->user()->can('demote', $user))
                        return '<a href="javascript:void(0)"
                            data-url="/masters/users/' . $user->id . '/revoke-admin"
                            class="btn btn-danger fetch_user_details"
                            title="Demote user" >
                                Demote
                            </a>';
                    else
                        return ;
                }
                else
                    return '<a href="javascript:void(0)"
                        data-url="/masters/users/' . $user->id . '/make-admin"
                        class="btn btn-success fetch_user_details"
                        title="Promote user" >
                            Promote
                        </a>';

            })
            ->rawColumns(['actions', 'role'])
            ->setFilteredRecords($numberOfFilteredRows)
            ->setTotalRecords($numberOfTotalRows)
            ->setRowId('id')
            ->make(true);
    }

    public function makeAdmin(User $user){
        if($user->makeAdmin()){
            session()->flash('success', 'User has been assigned admin role!');
        }else{
            session()->flash('error', 'User couldn\'t be assigned admin role!');
        }
        return redirect(route('users.index'));
    }

    public function revokeAdmin(User $user){
        if($user->revokeAdmin()){
            session()->flash('success', 'User has been assigned member role!');
        }else{
            session()->flash('error', 'User couldn\'t be assigned member role!');
        }
        return redirect(route('users.index'));
    }
}
