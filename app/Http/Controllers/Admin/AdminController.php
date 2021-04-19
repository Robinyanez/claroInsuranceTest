<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Message;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Requests\Msg\MsgRequest;
use App\Jobs\SendMailJob;
use Str;
use Hash;
use Auth;
use Mail;
use Artisan;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('city')->where('id', '!=', Auth::user()->id)->get();
        /* $users = User::with('city')->where('name', '!=', Auth::user()->id)->paginate(5); */
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::first();
        $provinces = Province::all();
        $cities = City::all();
        /* dd($countries); */
        return view('admin.create', compact('countries','provinces','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $users = new User;
        $users->name = $request->get('name');
        $users->slug = Str::slug($request->get('name'),'-');
        $users->identification_card = $request->get('identification_card');
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
        $users->date_of_birth = $request->get('date_of_birth');
        $users->id_cities = $request->get('id_cities');
        $users->password = Hash::make($request->get('password'));
        /* dd($users); */
        $users->save();

        session()->flash('success', 'Su registro se ingreso correctamente');
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $countries = Country::first();
        $provinces = Province::all();
        $cities = City::all();
        $users = $users = User::with('city')->findOrFail($id);
        return view('admin.show', compact('users','countries','provinces','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::first();
        $provinces = Province::all();
        $cities = City::all();
        $users = User::findOrFail($id);
        return view('admin.edit', compact('users','countries','provinces','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response.
     * Robin@#76246
     */
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
        /* dd($users); */
        $users->save();

        session()->flash('success', 'Su registro se ingreso correctamente');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        session()->flash('success', 'Su registro se elimino correctamente');
        return redirect()->back();
    }

    /**
     * Redireccionmiento para cerar un nuevo correo
     *
     * @return void
     */
    public function createmsgadmin(){
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('admin.sendmsg', compact('users'));
    }

    /**
     * Metodo para creacion y envio de mensajes
     *
     * @param  mixed $request
     * @return void
     */
    public function sendmsgadmin(MsgRequest $request){

        $msgStatus = 'I';
        $id_user = Auth::user()->id;

        $email_user = Auth::user()->email;

        $msg = new Message;
        $msg->asunto = $request->get('asunto');
        $msg->destinatario = $request->get('destinatario');
        $msg->mensaje = $request->get('mensaje');
        $msg->status = $msgStatus;
        $msg->id_users = $id_user;
        /* $msg->save(); */

        $details = ['destinatario' => $msg->destinatario,
                    'asunto' => $msg->asunto,
                    'remitente' => $email_user,
                    'mensaje' => $msg->mensaje
                    ];

                    /* dd($details); */

        SendMailJob::dispatch($details);

        session()->flash('success', 'Su registro se ingreso correctamente');
        return redirect()->route('admin.index');

    }

    /**
     * Enviar los mensajes encolados mediante un comando de Artizan
     *
     * @return void
     */
    public function sendQueues(){
        Message::where('status','=','I')->update(['status' => 'A']);
        Artisan::call("queue:work --stop-when-empty");
        session()->flash('success', 'Mensajes enviados con exito');
        return redirect()->route('admin.index');
    }

    /**
     * Ver listado de mensajes
     *
     * @param  mixed $id
     * @return void
     */
    public function showmsg($id)
    {
        $users = Message::with('users')->where('destinatario', Auth::user()->email)->findOrFail($id);
        return view('admin.showmsg', compact('users'));
    }

    public function listmsg(){
        $users = Message::with('users')->where('destinatario', Auth::user()->email)->get();
        return view('admin.listmsg', compact('users'));
    }

    /* public function getCity(Request $request)
    {
        if (!$request->id_provinces) {
            $html = '<option value="">No existen datos</option>';
        } else {
            $html = '';
            $cities = City::where('id_provinces','=', $request->id_provinces)->get();
            foreach ($cities as $city) {
                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    } */
}
