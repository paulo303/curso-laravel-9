<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            if ($request->image) {
                $data['image'] = $request->image->store('users');
                // $extensao = $request->image->getClientOriginalExtension();
                // $data['image'] = $request->image->storeAs('users', now() . ".{$extensao}");
            }

            $user = $this->model->create($data);

            $user->preference()->create();

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

        return view('users.edit', compact([
            'user',
            'title',
        ]));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            if (!$user = $this->model->getUser($id))
                return redirect()->route('users.index');

            $data = $request->only([
                'name',
                'email',
                'image',
            ]);

            if ($request->image) {
                if ($user->image && Storage::exists($user->image))
                    Storage::delete($user->image);

                $data['image'] = $request->image->store('users');
            }

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
