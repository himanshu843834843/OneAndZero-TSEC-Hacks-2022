<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UsersService;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class UsersController extends Controller
{
    public function __construct(UsersService $service)
    {
        $this->service = $service;
        // $this->middleware('admin')->except('show');
        // $this->middleware('loggedInUser')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.user.user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('masters.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('masters.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $this->service->update($user, $request->toArray());
            return view('masters.user.user');
        } catch (ValidationException $exception) {
            return redirect()->route('users.index')->withErrors($exception->errors());
        } catch (Exception $exception) {
            return redirect()->route('users.index')->withErrors($exception->getMessage());
        } catch (Throwable $exception) {
            return redirect()->route('users.index')->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id){
        $user = User::findOrFail($id);
        return $this->service->destroy($user);
    }



    public function getUsersJson(Request $request): JsonResponse{
        try {
            return $this->service->getUsers(
                $request->search['value'],
                $request->order,
                $request->start,
                $request->length
            );
        }catch (Exception $e){
            return response()->json(['message' => 'Something Went Wrong'.$e->getMessage()],500);
        }
    }

    public function makeAdmin(User $user){
        return $this->service->makeAdmin($user);
    }

    public function revokeAdmin(User $user){
        return $this->service->revokeAdmin($user);
    }
}
