<?php

namespace App\Http\Controllers;

use App\Breadcrumbs;
use App\Forgot;
use App\Mail\ForgotMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function restore(Request $request)
    {
        //клик по ссылке в письме для вызова формы нового пароля
        if (!empty($request->hash)) {
            $item = Forgot::where(['hash' => $request->hash])->firstOrFail();
            if (isset($item)) {
                // dd($item);
                $hash = $item->hash;
                $breadcrumbs = Breadcrumbs::getBreadcrumbs('', 'Create new password');
                return view('forgot.restore', compact('hash', 'breadcrumbs'));
            }
            //если ссылка битая (!$item)- то срабатывает firstOrFail()- 404 page not found

        }
        //получение email для запроса нового пароля- старт операции метод POST
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where(['email' => $request->email])->first();

        if (empty($user)) {
            return redirect()->back()->with('error', 'Неверный email');
        }
        $expire = time() + 3600;
        $hash = md5($expire . $request->email);
        // прошли проверку - вносим данные в табл
        Forgot::create([
            'hash' => $hash,
            'expire' => $expire,
            'email' => $request->email,
        ]);
        // dd($expire, $hash);
        //отправляем письмо на email с ссылкой по которой надо перeйти
        Mail::to($request->email)->send(new ForgotMail($hash));
        return redirect()->back()->with('success', 'Письмо с ссылкой отправлено на Ваш email');
    }
    public function create(Request $request)
    {
        //получение нового пароля с подтверждением от usera
        if ($request->method() == "POST") {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $now = time();
            $items = Forgot::all();
            foreach ($items as $item) {
                if ($item->expire - $now < 0) {
                    $item->delete();
                }
            }
            $item = Forgot::where(['hash' => $request->hash])->firstOrFail();
            if ($item->expire - $now < 0) {
                $item->delete();
                return redirect()->route('login')->with('error', 'Время ссылки истекло');
            }
            //прошли все проверки-перезапишем данные usera
            $pass_hash = bcrypt($request->password);
            $user = User::where(['email' => $item->email])->firstOrFail();
            $user->update([
                'password' => $pass_hash,
            ]);
            //удаляем действующий $item
            $item->delete();
            //Breadcrumbs
            $breadcrumbs = Breadcrumbs::getBreadcrumbs('', 'login');
            // $request->session()->flash();
            return redirect(route('login.create'))->with('success', 'Пароль восстановлен, пройдите авторизацию.');
        }
    }
}
