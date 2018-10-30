<?php

namespace App;

use App\Traits\Models\Impersonator;
use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\SearchLikeTrait;
use App\Traits\Models\FillableFields;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, FillableFields, OrderableTrait, SearchLikeTrait, Impersonator;
    
    protected $table = 'WARELINE.tblusu';
    protected $primaryKey = 'usucod';
    public function username()
    {
        return 'usunome';
    }
    public function getAuthPassword(){
        return $this->ususenha;
    }

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
          parent::setAttribute($key, $value);
      }
    }
    protected $fillable = [
        'usunome', 'ususenha', 'status', 'acessos', 'origem', 'NOME', 'codger', 'nome', 'senhamaster', 'origem2', 'coduni', 'provisoria', 'codvend', 'situacao', 'modulo'
    ]; 

    public function isAdmin()
    {
        return (int) $this->is_admin === 1;
    }

    /**
     * @return string
     */
    public function getLogoPath()
    {
        return Utils::logoPath($this->logo_number);
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->name;
    }

    
}
