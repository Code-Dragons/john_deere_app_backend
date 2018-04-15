<?php
/** 
 * Report Controller 
 * 
 * @category Report
 * 
 * */
namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Contribution;
use App\Models\Group;


class ReportController extends Controller
{
    /**
     * Gives report of individual and group 
     * contribution.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getStats($user_id)
    {
        $user_details = User::where('id', $user_id)->first();

        $total_personal_contribution = Contribution::where('user_id', $user_id)
        ->sum('amount');
        $total_group_contribution = Contribution::where(
            'group_id', 
            $user_details->group_id
        )
        ->sum('amount');

        $group_details = Group::where('id', $user_details->group_id)
        ->first();
        $total_members = User::where('group_id', $user_details->group_id)
        ->count();

        $personal_amount_remaining = ($group_details->loan_amount / $total_members) 
        - ($total_personal_contribution);
        $group_amount_remaining = $group_details->loan_amount 
        - $total_group_contribution;

        return new JsonResponse(
            [
            'total_personal_contribution' => $total_personal_contribution,
            'total_group_contribution' => $total_group_contribution,
            'total_group_loan' => $group_details->loan_amount,
            'personal_amount_remaining' => $personal_amount_remaining,
            'group_amount_remaining' => $group_amount_remaining,
            'total_group_members' => $total_members
            ]
        );
    }
}
