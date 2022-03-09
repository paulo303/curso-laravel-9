<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        $title = 'Listagem dos Usuários';

        $users = $this->model->getUsers($request->search);

        return view('users.index', compact([
            'title',
            'users',
        ]));
    }

    public function show($id)
    {
        // $user = $this->model->findOrFail($id); // pra API
        if (!$user = $this->model->getUser($id))
            return redirect()->route('users.index');

        $title = 'Dados do Usuário ' . $user->name;

        return view('users.show', compact([
            'title',
            'user',
        ]));
    }

    public function create()
    {
        $title = 'Novo usuário';

        return view('users.create', compact('title'));
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);

            $user = $this->model->create($data);

            Preference::create([
                'user_id' => $user->id
            ]);

            DB::commit();

            return redirect()->route('users.index');

        } catch (\Exception $exception) {
            DB::rollBack();

            return response([
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if (!$user = $this->model->getUser($id))
            return redirect()->route('users.index');

        $title = 'Editar o Usuário ' . $user->name;

        return view('users.edit', compact('user'));
    }

    // public function update(StoreUpdateUserFormRequest $request, $id)
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            if (!$user = $this->model->getUser($id))
                return redirect()->route('users.index');

            $data = $request->only([
                'name',
                'email',
            ]);

            if ($request->password)
                $data['password'] = bcrypt($request->password);

            $user->update($data);

            DB::commit();

            return redirect()->route('users.index');

        } catch (\Exception $exception) {
            DB::rollBack();

            return response([
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            if (!$user = $this->model->getUser($id))
                return redirect()->route('users.index');

            $user->preference()->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('users.index');

        } catch (\Exception $exception) {
            DB::rollBack();

            return response([
                "error" => $exception->getMessage()
            ]);
        }

    }
}
