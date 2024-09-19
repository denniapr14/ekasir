<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\User;
use Carbon\Carbon;

use Image;
class C_User extends Controller
{
    //
    public $user;
    function __construct() {
        $this->user = new User();
    }

    function index() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getUser = $this->user->getUser()->collect();
        $getUser = $getUser->whereIn('levelUser', ['kasir', 'costumer']);

        if (session()->has('user')) {
            # code...
            return view('Dashboard.user',
                compact(

                    'userData',
                    'getUser'
                ));
        }else{
            return redirect()->route('login');
        }
    }
    function adduser() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        if (session()->has('user')) {
            # code...
            return view('Dashboard.adduser',
                compact(

                    'userData'
                ));
        }else{
            return redirect()->route('login');
        }
    }
    function addUserAction(Request $request) {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);



        $imgUser="";
        if (!empty($request->file('imgUser'))) {
            $image = $request->file('imgUser');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Upload original image
            $image->move(public_path('Uploads/photoUser'), $imageName);

            // Compress and save a new version
            $compressedImage = Image::make(public_path('Uploads/photoUser/'. $imageName))
                ->encode('jpg', 50); // Specify compression quality

            // Ensure that the destination directory exists
            $compressedDirectory = public_path('Uploads/photoUserCompressed/');
            if (!file_exists($compressedDirectory)) {
                mkdir($compressedDirectory, 0755, true);
            }

            // Save the compressed image
            $compressedImage->save(public_path('Uploads/photoUserCompressed/' . $imageName));

            $imgUser = $imageName;
        }else {
            $imgUser = $userData->photoUser;
        }

        if (session()->has('user')) {

            $this->user->insertUser(
                [
                    'nameUser'          => $request->nameUser,
                    'usernameUser'      => $request->usernameUser,
                    'passwordUser'      => $request->passwordUser,
                    'phoneUser'         => $request->phoneUser,
                    'emailUser'         => $request->emailUser,
                    'addressUser'       => $request->addressUser,
                    'photoUser'         => $imgUser,
                    'levelUser'         => "kasir"
                ]
            );
            return redirect()->route('user')->with('sucess','User berhasil '.$request->nameUser.' di simpan');
        }else{
            return redirect()->route('login');
        }
    }

    function editUserAction(Request $request, $id) {
        $decryptedID = Crypt::decrypt($id);

        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $imgUser="";
        if (!empty($request->file('editPhotoUser'))) {
            $image = $request->file('editPhotoUser');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Upload original image
            $image->move(public_path('Uploads/photoUser'), $imageName);

            // Compress and save a new version
            $compressedImage = Image::make(public_path('Uploads/photoUser/'. $imageName))
                ->encode('jpg', 50); // Specify compression quality

            // Ensure that the destination directory exists
            $compressedDirectory = public_path('Uploads/photoUserCompressed/');
            if (!file_exists($compressedDirectory)) {
                mkdir($compressedDirectory, 0755, true);
            }

            // Save the compressed image
            $compressedImage->save(public_path('Uploads/photoUserCompressed/' . $imageName));

            $imgUser = $imageName;
        }else {
            $imgUser = $userData->photoUser;
        }


        if (session()->has('user')) {

            DB::table('user')
            ->where('id_user', $decryptedID) // Assuming $productId is the ID of the product you want to update
            ->update([
                'nameUser'          => $request->editName,
                'phoneUser'         => $request->editPhone,
                'emailUser'         => $request->editEmail,
                'addressUser'       => $request->editAddress,
                'photoUser'         => $imgUser,
                'levelUser'         => $request->editLevel,
                'statusUser'    => $request->statusUser,
                'dateUpdateUser'    => Carbon::now()
                ]);

            return redirect()->route('user')->with('sucess','User berhasil '.$request->nameUser.' di simpan');
        }else{
            return redirect()->route('login');
        }
    }

    function editProfile() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        if (session()->has('user')) {

           return view('Dashboard.editProfile',compact('userData'));


        }else{
            return redirect()->route('login');
        }
    }
    function editProfileAction(Request $request) {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $imgUser="";
        if (!empty($request->file('photoUser'))) {
            $image = $request->file('photoUser');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Upload original image
            $image->move(public_path('Uploads/photoUser'), $imageName);

            // Compress and save a new version
            $compressedImage = Image::make(public_path('Uploads/photoUser/'. $imageName))
                ->encode('jpg', 50); // Specify compression quality

            // Ensure that the destination directory exists
            $compressedDirectory = public_path('Uploads/photoUserCompressed/');
            if (!file_exists($compressedDirectory)) {
                mkdir($compressedDirectory, 0755, true);
            }

            // Save the compressed image
            $compressedImage->save(public_path('Uploads/photoUserCompressed/' . $imageName));

            $imgUser = $imageName;
        }else {
            $imgUser = $userData->photoUser;
        }

        if (session()->has('user')) {
        //    dd($request->all());

            $dataUpdateUser = [
                'nameUser'      => $request->nameUser,
                'phoneUser'     => $request->phoneUser,
                'emailUser'     => $request->emailUser,
                'addressUser'   => $request->addressUser,
                'photoUser'     =>  $imgUser,
                'passwordUser'  => md5($request->passwordUser),

            ];
            DB::table('user')
            ->where('id_user', $userData->id_user) // Assuming $productId is the ID of the product you want to update
            ->update( $dataUpdateUser);

            return redirect()->back()->with('success','data telah di ubah!');
        }else{
            return redirect()->route('login');
        }
    }
    public function deleteUser($id_user)  {
        $decryptedID = Crypt::decrypt($id_user);
        $dataUpdateUser = [
           'statusUser' =>'nonactive',
        ];
        DB::table('user')
        ->where('id_user',  $decryptedID) // Assuming $productId is the ID of the product you want to update
        ->update( $dataUpdateUser);
        return redirect()->back()->with('success','data telah dihapus');
    }
}
