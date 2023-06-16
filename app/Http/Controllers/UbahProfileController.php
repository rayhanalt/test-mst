<?php

namespace App\Http\Controllers;


use App\Models\guru;
use App\Models\siswa;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UbahProfileController extends Controller
{
     public function editUser(User $user)
     {
          if (Auth::user()->jabatan == 'admin' && Auth::user()->username == $user->username) {
               return view('user.edit', [
                    'item' => $user,

               ]);
          }
          if (Auth::user()->jabatan == 'guru' && Auth::user()->username == $user->username) {
               return view('user.editGuru', [
                    'item' => $user,
                    'guru' => guru::where('nip', $user->username)->first()
               ]);
          }
          if (Auth::user()->jabatan == 'siswa' && Auth::user()->username == $user->username) {
               return view('user.editSiswa', [
                    'item' => $user,
                    'siswa' => siswa::where('nis', $user->username)->first()
               ]);
          }
          return redirect()->back()->with('error', 'anda tidak memiliki hak akses');
     }

     // update
     public function updateUser(Request $request, user $user)
     {
          $request->validate([
               'username' => 'required'
          ]);

          if ($user->username != $request->username) {
               $request->validate([
                    'username' => 'unique:users,username'
               ]);
          }

          if ($request->password != null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
               ]);

               Auth::logout();
               $request->session()->invalidate();
               $request->session()->regenerateToken();
               return redirect('/loginpage')->with('failed', 'Silahkan Login Kembali dengan password baru');
          }

          if ($request->password == null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
               ]);

               return redirect('/')->with('success', 'Data has been updated!')->withInput();
          }
     }

     public function updateGuru(Request $request, user $user)
     {
          $request->validate([
               'username' => 'required',
               'nama_guru' => 'required',
               'kode_mapel' => 'required',
          ]);

          if ($user->username != $request->username) {
               $request->validate([
                    'username' => 'unique:users,username|unique:guru,nip'
               ]);
          }

          if ($request->password != null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
               ]);

               guru::where('nip', $user->username)->update([
                    'nip' => $request->username,
                    'nama_guru' => $request->nama_guru,
                    'kode_mapel' => $request->kode_mapel,
               ]);

               Auth::logout();
               $request->session()->invalidate();
               $request->session()->regenerateToken();
               return redirect('/loginpage')->with('failed', 'Silahkan Login Kembali dengan password baru');
          }

          if ($request->password == null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
               ]);
               guru::where('nip', $user->username)->update([
                    'nip' => $request->username,
                    'nama_guru' => $request->nama_guru,
                    'kode_mapel' => $request->kode_mapel,
               ]);

               return redirect('/')->with('success', 'Data has been updated!')->withInput();
          }
     }

     public function updateSiswa(Request $request, user $user)
     {
          $request->validate([
               'username' => 'required',
               'nama_lengkap' => 'required',
               'nama_panggilan' => 'required',
               'tempat_lahir' => 'required',
               'tanggal_lahir' => 'required',
               'jenis_kelamin' => 'required',
               'alamat' => 'required',
               'no_telp' => 'required',
          ]);

          if ($user->username != $request->username) {
               $request->validate([
                    'username' => 'unique:users,username|unique:siswa,nis'
               ]);
          }

          if ($request->password != null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
               ]);

               siswa::where('nis', $user->username)->update([
                    'nis' => $request->username,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nama_panggilan' => $request->nama_panggilan,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
               ]);

               Auth::logout();
               $request->session()->invalidate();
               $request->session()->regenerateToken();
               return redirect('/loginpage')->with('failed', 'Silahkan Login Kembali dengan password baru');
          }

          if ($request->password == null) {

               DB::table('users')->where('username', '=', $user->username)->update([
                    'username' => $request->username,
               ]);

               siswa::where('nis', $user->username)->update([
                    'nis' => $request->username,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nama_panggilan' => $request->nama_panggilan,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
               ]);

               return redirect('/')->with('success', 'Data has been updated!')->withInput();
          }
     }
}
