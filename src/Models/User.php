<?php

namespace Kgalanos\User\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use kgalanos\conversion;
use Kgalanos\PartnerAragGr\Models\prakfn;
use Kgalanos\PartnerAragGr\Models\sym;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    //    use HasUlids;
    //    use SoftDeletes;
    use HasRoles;

    const FIILABLE_ARRAY = [
        'username',
        //        'is_admin',
        'email',
        'name',
        'password',
        'phone',
        'last_login_at',
        'last_login_ip',
        //        'ban_from',
        //        'ban_until',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = self::FIILABLE_ARRAY;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function lastLoginAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) {
                    return '';
                }

                return \Carbon\Carbon::parse($value)->diffForhumans();

            },
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => conversion\Date\ToString::setValue($value)->format(),
        );
    }

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => conversion\Date\ToString::setValue($value)->format(),
        );
    }

    public function canAccessFilament(): bool
    {
        // TODO: Implement canAccessFilament() method.
        return true;
    }

    public function syms(): ?HasMany
    {
        return $this->hasMany(sym::class, 'username', 'username');
    }

    public function prakfns(): ?HasMany
    {
        return $this->hasMany(prakfn::class, 'username', 'username');
    }

    public function inspectors(): ?HasMany
    {
        return $this->hasMany(prakfn::class, 'inspector', 'username');
    }

    public function userRoles()
    {
        return $this->roles()->pluck('name')->implode(' ');
    }

    public function userPrakfns()
    {
        return $this->prakfns()->pluck('username')->toArray();
    }

    public function userInspectors()
    {
        //        dd($this->prakfns());
        return $this->Inspectors()->pluck('username')->toArray();
    }
}
