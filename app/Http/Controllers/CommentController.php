<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCommentFormRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    protected $model;
    protected $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->model = $comment;
        $this->user = $user;
    }

    public function index(Request $request, $userId)
    {
        if (!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        $title = 'Comentários do Usuário ' . $user->name;

        // $comments = $user->comments()->get();

        $comments = $this->model->getComments($request->search, $user);

        $search = $request->search;

        return view('users.comments.index', compact('title', 'user', 'comments', 'search'));
    }

    public function create($userId)
    {
        if (!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        $title = 'Novo comentário';

        $comments = $user->comments()->get();

        return view('users.comments.create', compact('title', 'user', 'comments'));
    }

    public function store(StoreUpdateCommentFormRequest $request, $userId)
    {
        if (!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $user->comments()->create([
                'body' => $request->body,
                'visible' => $request->has('visible'),
            ]);
            DB::commit();

            return redirect()->route('comments.index', $user->id);

        } catch (\Exception $exception) {
            DB::rollBack();

            return response([
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function edit($userId, $id)
    {
        if (!$comment = $this->model->find($id)) {
            return redirect()->back();
        }

        $user = $comment->user;

        $title = "Editar o comentário do usuário {$user->name}";

        $comments = $user->comments()->get();

        return view('users.comments.edit', compact('title', 'user', 'comment'));
    }

    public function update(StoreUpdateCommentFormRequest $request, $id)
    {
        if (!$comment = $this->model->find($id)) {
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $comment->update([
                'body' => $request->body,
                'visible' => $request->has('visible'),
            ]);
            DB::commit();

            return redirect()->route('comments.index', ['id' => $comment->user_id]);

        } catch (\Exception $exception) {
            DB::rollBack();

            return response([
                "error" => $exception->getMessage()
            ]);
        }
    }
}
