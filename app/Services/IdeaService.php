<?php

namespace App\Services;

use App\Models\Idea;
use Carbon\Carbon;

class IdeaService
{
    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Idea::all();
    }
    public function find($id)
    {
        // Lấy thông tin người dùng theo ID
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
}
