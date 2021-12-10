<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];

    protected $allowIncluded = ['posts', 'posts.user'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Este query Scope sirve para que obtener
     * las categirias por relaciones
     */
    public function scopeIncluded(Builder $query)
    {

        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relation = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relation as $key => $relationShip) {
            if (!$allowIncluded->contains($relationShip)) {
                unset($relation[$key]);
            }
        }

        $query->with($relation);
    }


    /**
     * Este query scope sirve para obtener
     * las categorias por filtors
     */
    public function scopefilter(Builder $query)
    {

        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);


        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', "%$value%");
            }
        }
    }


    /**
     * Esta query scope sirve para ordernar los elementos
     * 
     */
    public function scopesort(Builder $query)
    {

        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sorts =  explode(',', request('sort'));
        $allowSort = collect($this->allowSort);


        foreach ($sorts as $sortField) {

            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }


    /**
     * Sirve para paginar
     */
    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
