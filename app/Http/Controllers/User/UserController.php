<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\Message;
use App\Models\City;
use App\Http\Requests\Msg\MsgRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Jobs\SendMailJob;
use Str;
use Hash;
use Auth;
use Mail;

class UserController extends Controller
{
    /**
     * Presentacion de datos de correo del usuario loggeado
     *
     * @return void
     */
    public function index(){
        $users = Message::with('users')->where('destinatario', Auth::user()->email)->get();
        return view('user.index', compact('users'));
    }


    /**
     * Metodo para editar los datos del usuario loggeado.
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $countries = Country::first();
        $provinces = Province::all();
        $cities = City::all();
        $users = User::findOrFail($id);
        return view('user.profile', compact('users','countries','provinces','cities'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $users = User::findOrFail($id);
        $users->name = $request->get('name');
        $users->slug = Str::slug($request->get('name'),'-');
        $users->identification_card = $request->get('identification_card');
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
        $users->date_of_birth = $request->get('date_of_birth');
        $users->id_cities = $request->get('id_cities');
        $users->password = Hash::make($request->get('password'));
        $users->save();

        session()->flash('success', 'Su registro se ingreso correctamente');
        return redirect()->route('admin.index');
    }

    /**
     * Metodo para ver un mensaje en especifico
     *
     * @param  mixed $id
     * @return void
     */
    public function showmsg($id)
    {
        $users = Message::with('users')->where('destinatario', Auth::user()->email)->findOrFail($id);
        return view('user.showmsg', compact('users'));
    }

    /**
     * Redireccionmiento para cerar un nuevo correo
     *
     * @return void
     */
    public function createmsg(){
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('user.sendmsg', compact('users'));
    }

    /**
     * Metodo para creacion y envio de mensajes
     *
     * @param  mixed $request
     * @return void
     */
    public function sendmsg(MsgRequest $request){

        $msgStatus = 'I';
        $id_user = Auth::user()->id;
        $email_user = Auth::user()->email;

        $msg = new Message;
        $msg->asunto = $request->get('asunto');
        $msg->destinatario = $request->get('destinatario');
        $msg->mensaje = $request->get('mensaje');
        $msg->status = $msgStatus;
        $msg->id_users = $id_user;
        $msg->save();

        $details = ['destinatario' => $msg->destinatario,
                    'asunto' => $msg->asunto,
                    'remitente' => $email_user,
                    'mensaje' => $msg->mensaje
                    ];

        SendMailJob::dispatch($details);

        session()->flash('success', 'Su registro se ingreso correctamente');
        return redirect()->route('user.index');

    }
}
