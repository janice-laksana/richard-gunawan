<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Nationality;
use App\Models\Sertifikat;
use App\Models\Skill;
use App\Rules\Rules\NoHP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        $skill = Skill::with('category')->where('user_id',Auth::user()->id)->get();
        $sertifikat = Sertifikat::where('user_id',Auth::user()->id)->get();
        $nations = Nationality::all();
        return view('user.profile.index',['category'=>$category,'sertifikat'=>$sertifikat,'skill'=>$skill,'nations'=>$nations]);
    }

    public function store(Request $request,$action)
    {
        switch ($action) {
            case 3 :
                //add skills
                $request->validate([
                    'skill_name' => 'required|min:5'
                ]);
                $request->request->set('user_id',Auth::user()->id);
                Skill::create($request->all());
                $section = "skills";
                return redirect('/profile/')->with('success','Your '.$section.' profile has been updated!');;
                break;
            case 5 :
                //add certification
                $request->validate([
                    'sertifikat_from' => 'required|min:2',
                    'sertifikat_name' => 'required|min:2',
                    'sertifikat_year' => 'required|numeric'
                ]);
                $request->request->set('user_id',Auth::user()->id);
                Sertifikat::create($request->all());
                $section = "certification";
                return redirect('/profile/')->with('success','Your '.$section.' profile has been updated!');;
                break;
            default:
                break;
        }
    }

    public function show(Request $request)
    {
        
    }

    public function update(Request $request,$action)
    {
        $user = Auth::user();
        switch ($action) {
            case 0 :
                //update general
                $request->validate([
                    'user_name' => 'required|min:2',
                    'user_phone' => ['required','min:10', new NoHP]
                ]);

                $user->name = $request->user_name;
                $user->user_phone = $request->user_phone;
                $user->save();
                $section = "general";
                return redirect('/profile/')->with('success','Your '.$section.' profile has been updated!');
                break;
            case 1 :
                //update detail
                $request->validate([
                    'user_age' => 'required|numeric|min:17',
                    'user_desc' => 'required|min:15',
                ]);

                $user->user_age = $request->user_age;
                $user->nationality_id = $request->nationality_id;
                $user->user_gender = $request->user_gender;
                $user->user_desc = $request->user_desc;
                $user->save();
                $section = "detail";
                return redirect('/profile/')->with('success','Your '.$section.' profile has been updated!');
                break;
            case 2 :
                //update pass
                $request->validate([
                    'pass' => 'required|min:3',
                    'confirm' => 'same:pass',
                ]);

                if ($request->pass == $request->confirm){
                    $hashed["password"] = Hash::make($request->pass);
                    Auth::user()->update($hashed);
                }
                $section = "privacy";
                return redirect('/profile/')->with('success','Your '.$section.' profile has been updated!');
                break;
            default:
                break;
        }
    }

    public function destroy(Request $request)
    {
        
    }

    // function di bawah ini digunakan untuk menambahkan ataupun menghapus mhs yang diajar seorang dosen
    public function action(Request $request)
    {
        
    }
}
