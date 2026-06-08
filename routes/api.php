<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Sesuaikan dengan model user SIAKAD

Route::post('/verify-login', function (Request $request) {
    // SIAKAD mengecek email dan password yang dikirim EduTrace
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $student = $user->student; // Mengambil relasi data siswa di SIAKAD

        return response()->json([
            'status' => 'success',
            'data' => [
                'nama' => $student ? $student->name : $user->name,
                'email' => $user->email,
                // Anda bisa menambahkan data akademik lainnya di sini nanti
            ]
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
});