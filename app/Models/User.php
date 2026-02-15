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
        'l_name',
        'f_name',
        'm_name',
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
            'birthday' => 'date',
        ];
    }

   public function getLastName(): string
   {
       return $this->l_name;
   }
   public function getFirstName(): string
   {
       return $this->f_name;
   }

   public function getMiddleName(): ?string
   {
       return $this->m_name;
   }

   public function getFullName(): string
   {
       return $this->l_name . ' ' . $this->f_name . ' ' . $this->m_name;
   }

   public function getEmail(): string
   {
       return $this->email;
   }
   public function getBirthday(): ?string
   {
       return $this->birthday;
   }
   public function getPhone(): ?string
   {
       return $this->phone;
   }
   public function getAddress(): ?string
   {
       return $this->address;
   }
   public function getRole(): string
   {
       return $this->role;
   }

    public function getIsAdminAttribute(): bool
    {
        return $this->getRole() === 'admin';
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
