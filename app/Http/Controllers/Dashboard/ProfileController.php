<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit() {
        $user = auth()->user();
        $countries = Countries::getNames("ar");
        $locales = Languages::getNames();

        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => $countries, // تمرير الدول إلى الـ view
            'locales' => $locales,     // تمرير اللغات إلى الـ view
        ]);
    }

    public function update(ProfileRequest $request){
        $validatedData = $request->validated(); // الحصول على البيانات بعد التحقق
        $user = $request->user();
        $user->profile->fill($validatedData)->save();
    //     $user = $request->user();
    //     $profile = $user->profile;
    //     if($profile->user_id){
    //         $profile->update($validatedData);
    //     }else{
    //    $user->profile()->create($validatedData);
    //     }
        return redirect()->route("dashboard.profile.edit")->with("success","Profile updated successfully.");
    }

// public function update(ProfileRequest $request){
//     $validatedData = $request->validated(); // الحصول على البيانات بعد التحقق

    // الحصول على المستخدم الحالي
//     $user = $request->user();

    // التحقق من وجود الملف الشخصي وتحديثه أو إنشائه إذا لم يكن موجودًا
//     if($user->profile){
//         $user->profile->fill($validatedData)->save();
//     } else {
//         $user->profile()->create($validatedData);
//     }

//     return redirect()->back()->with("success","Profile updated successfully.");
// }

}
