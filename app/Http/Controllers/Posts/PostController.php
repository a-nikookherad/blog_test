<?php

namespace App\Http\Controllers\Posts;

use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //get query from repository
        $postRepository = new PostRepository();
        $postCollection = $postRepository->read(\request("limit") ?? 10);
        return view("post.index", compact("postCollection"));
    }

    public function create()
    {
        return view("post.create");
    }

    public function store(PostStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            //get query from repository
            $postRepository = new PostRepository();

            //insert post to database
            $postInstance = $postRepository->create($request->only([
                "title",
                "content",
            ]));

            //check post exist
            if (!$postInstance instanceof Post) {
                throw new PostException("something went wrong");
            }

            //add media for post instance
            $postInstance->addMedia($request->file("image"))
                ->toMediaCollection();
            DB::commit();
            return redirect()->back()->with("success", "post add successfully");

        } catch (\Throwable $exception) {
            DB::rollBack();
            throw($exception);
        }
    }

    public function show($id)
    {
        //get query from repository
        $postRepository = new PostRepository();
        $postInstance = $postRepository->show($id);

        //check post exist
        if (!$postInstance instanceof Post) {
            throw new PostException("Post not found!");
        }

        return view("post.show", compact("postInstance"));
    }

    public function edit($id)
    {
        $postRepository = new PostRepository();
        $postInstance = $postRepository->show($id);

        //check post exist
        if (!$postInstance instanceof Post) {
            throw new PostException("Post not found!");
        }
        return view("post.edit", compact("postInstance"));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            //get query from repository
            $postRepository = new PostRepository();
            $postInstance = $postRepository->show($id);

            //check post exist
            if (!$postInstance instanceof Post) {
                throw new PostException("Post not found!");
            }

            //update post
            $postInstance->title = $request->filled("title") ? $request->title : $postInstance->title;
            $postInstance->content = $request->filled("content") ? $request->content : $postInstance->content;
            $postInstance->save();

            //check change image file
            if ($request->exists("image")) {
                //delete media and file
                $postInstance->clearMediaCollection();

                //add new media
                $postInstance->addMedia($request->file("image"))
                    ->toMediaCollection();
            }

            DB::commit();
            return redirect()->route("posts.index")->with("success", "record updated successfully");
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw($exception);
        }

    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            //get query from repository
            $postRepository = new PostRepository();
            $postInstance = $postRepository->show($id);

            //check post exist
            if (!$postInstance instanceof Post) {
                throw new PostException("Post not found!");
            }

            //soft delete post record
            $postInstance->delete();

            DB::commit();
            return redirect("posts")->with("success", "record deleted successfully");
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw($exception);
        }
    }
}
