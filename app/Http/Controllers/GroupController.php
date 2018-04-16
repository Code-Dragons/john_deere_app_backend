<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Group;
use App\Models\Tractor;

class GroupController extends Controller
{
    /**
     * create a group
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            "name" => "string|required",
            "location" => "string|required",
            "members" => "json|required"
        ]);

        $exists = Group::where('name', $request->name)->first();

        if ($exists) {
            return (
                new JsonResponse(
                    ["error" => "Group name already exists"],
                    response::HTTP_BAD_REQUEST
                )
            );
        }

        $group = Group::create([
            "name" => $request->name,
            "location" => $request->location,
            "members" => $request->members,
            "created_by" => $request->user()->id
        ]);

        return (new JsonResponse($group, response::HTTP_CREATED));
    }

    /**
     * get all users
     *
     * @return JsonResponse
     */
    public function getUsers()
    {
        if ($users = User::with('group')->get()) {
            return (new JsonResponse($users, 200));
        }
        return (
        new JsonResponse(
            ["message" => "No users"],
            response::HTTP_NOT_FOUND
        )
        );
    }

    /**
     * get all tractors
     *
     * @return JsonResponse
     */
    public function getTractors()
    {
        $tractors = Tractor::with('model', 'category', 'drive')->get();

        if ($tractors) {
            return (new JsonResponse($tractors, response::HTTP_OK));
        }
        return (
            new JsonResponse(
                ["message" => "No tractors"],
                response::HTTP_NOT_FOUND
            )
        );
    }

    /**
     * Select tractor
     * 
     * @param Request $request
     */
    public function selectTractor(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'integer|required',
            'tractor_id' => 'integer|required'
        ]);

        $tractor = Tractor::select('amount')
            ->where('id', $request->tractor_id)
            ->first();
        if (!$tractor) {
            return (new JsonResponse(["message" => "Tractor id does not exist"], response::HTTP_BAD_REQUEST));
        }
        
        $group = Group::find($request->group_id);
        if ($group) {
            $group->loan_amount += $tractor->amount;
            $group->tractor_ids = [$request->tractor_id];
            $group->save();

            return (new JsonResponse($group, response::HTTP_OK));
        }

        return (new JsonResponse(["message" => "Group id does not exist"], response::HTTP_BAD_REQUEST));
    }
}
