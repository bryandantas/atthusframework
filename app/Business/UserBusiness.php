<?php


namespace App\Business;


use App\Enums\RolesType;
use App\Models\User;
use App\Support\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UserBusiness
{

    /**
     * Create a new user
     *
     * @TODO An email must be sent to the user with credentials data.
     *
     * @param array $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create(array $request)
    {
        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make(Str::random()),
        ]);

        if ($user->save()) {
            $user->assignRole(RolesType::USER);
            Message::flash('Usuário criado com sucesso');
            return Redirect::route('admin.users.user', ['id' => $user->id]);
        }
        Message::flash('Erro ao criar usuário, tente novamente', 'error');
        return Redirect::back();
    }

    public static function updateInfo(User $user, array $request)
    {
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($user->save()) {
            Message::flash('Informações atualizadas com sucesso');
            return Redirect::route('admin.users.user', ['id' => $user->id]);
        }
        Message::flash('Erro ao atualizar informações, tente novamente', 'error');
        return Redirect::back();
    }

    public static function updatePassword(User $user, array $request)
    {
        if (!Hash::check($request['password'], $user->getAuthPassword())) {
            Message::flash('Senha atual informada está incorreta', 'error');
            return Redirect::back();
        }

        if ($user->save()) {
            Message::flash('Senha atualizada com sucesso');
            return Redirect::route('admin.users.user', ['id' => $user->id]);
        }

        Message::flash('Erro ao atualizar senha, tente novamente', 'error');
        return Redirect::back();
    }

    public static function delete(User $user)
    {
        if ($user->delete()) {
            Message::flash('Usuário excluído com sucesso');
            return Redirect::route('admin.users');
        }
        Message::flash('Erro ao excluir usuário, tente novamente', 'error');
        return Redirect::back();
    }
}
