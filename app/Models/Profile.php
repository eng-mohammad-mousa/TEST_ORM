<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // مبعرف ليش ضافها
    // protected $table = "profiles";
    // مالها داعي
    protected $fillable = [
        // 'id', 'created_at', 'updated_at'   هو يملأها لذلك لا نكتبها

        'city',
        'user_id',
        'gender',
        'bio',
        'facebook'
    ];


    // إنشاء تابع ليدل على أن البروفايل تابع للمستخدم
    // عن طريق المتاح الأجنبي وهو
    // user_id
    // لذا سننشئ تابع باسم مستخدم ونكتب فيه ما يلي


    // فقط نكتب
    // belongsto
    // وهوة بكمل التابع لحالو

    /**
     * Get the user that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    // }

    public function user()
    {
// بعض المبرمجين قد لا يكتبو المفتاح الأجنبي اذا كان بهذا الاسم (اسم العمود بعده اي دي)
// لكن ان اردنا تغيير اسم العمود يجب ذكر اسم المفتاح الأجنبي

        return $this->belongsTo(User::class, 'user_id');
    }

}
