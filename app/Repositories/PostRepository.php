<?php


namespace App\Repositories;


use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    public function read($limit = 10)
    {
        return Post::query()
            ->with("author")
            ->orderBy("id", "desc")
            ->paginate($limit);
    }

    public function show($id)
    {
        return Post::query()
            ->with("author")
            ->where("id", $id)
            ->first();
    }

    public function exist($id)
    {
        return Post::query()
            ->where("id", $id)
            ->exists();
    }

    public function create($data)
    {
        $data["author_id"] = Auth::id();
        return Post::query()
            ->create($data);
    }

    public function update($id, $data)
    {
        return Post::query()
            ->where("id", $id)
            ->update($data);
    }

    public function softDelete($id)
    {
        return Post::query()
            ->where("id", $id)
            ->delete();
    }

    public function forceDelete($id)
    {
        return Post::query()
            ->where("id", $id)
            ->forceDelete();
    }
}
