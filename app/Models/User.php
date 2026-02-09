<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'surname',
        'email',
        'password',
        'avatar',
        'birthday',
        'phone',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birdthday' => 'datetime',
        ];
    }

   public function getLastName(): string
   {
       return $this->last_name;
   }
   public function getFirstName(): string
   {
       return $this->first_name;
   }
   public function getEmail(): string
   {
       return $this->email;
   }
   public function getBirthday(): string
   {
       return $this->birthday ?? 'Не найдено';
   }
   public function getPhone(): string
   {
       return $this->phone ?? 'Не найдено';
   }
   public function getAddress(): string
   {
       return $this->address ?? 'Не найдено';
   }
   public function getRole(): string
   {
       return $this->role;
   }
    public function setNumberAttribute($value): string
    {
        $phone = '+7 ' . $value;
        return $phone;
    }

    public function getIsAdminAttribute(): string
    {
        return $this->role == 'admin';
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
