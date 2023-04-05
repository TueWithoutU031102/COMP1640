<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\u;

class IdeaService
{

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Idea::all();
    }
    public function findById($id)
    {
        return Idea::find($id);
    }
    public function findBySubmission($submission)
    {
        return $submission->ideas;
    }

    public function save(){

    }

    public function update($id, $data)
    {
        // Cập nhật thông tin người dùng theo ID
    }

    public function delete($id)
    {
        // Xóa người dùng theo ID
    }

    public function checkDueDate($dD): bool
    {
        return Carbon::create($dD)->isFuture();
    }

    public function findIdeasByUserId(User $user){
        return $user->ideas;
    }
    public function findIdeasBySubmissionIdAndDepartmentId(int $submissionId, int $departmentId){
        return $ideas = Idea::where('submission_id', $submissionId)
            ->whereHas('department', function ($query) use ($departmentId) {
                $query->where('id', $departmentId);
            })
            ->get();
    }
    public function findIdeasBySubmissionIdAndCategoryId(int $submissionId, int $categoryId){
        return $ideas = Idea::where('submission_id', $submissionId)
            ->whereHas('category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->get();
    }
    public function findMostViewsIdeasBySubmissionId(int $submissionId){
        return 0;
    }
    public function findIdeasSortedNewestBySubmissionId(int $submissionId){
        return 0;
    }
}
