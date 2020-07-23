<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['documents_id', 'generate_films_id', 'generate_formats_id', 'generate_subjects_id',  'adaptations_id', 'photography_movies_id', 'subtitle', 
    'script', 'specific_content', 'awards', 'distributor'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($movie){

            $movie->actors()->detach()->delete();
        });
    }
    
    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    public function generate_movie()
    {
        return $this->belongsTo(Generate_film::class, 'generate_films_id');
    }

    public function generate_format()
    {
        return $this->belongsTo(Generate_format::class, 'generate_formats_id');
    }        

    public function adaptation()
    {
        return $this->belongsTo(Adaptations::class, 'adaptations_id');
    }

    public function photography_movie()
    {
        return $this->belongsTo(photography_movies::class, 'photography_movies_id');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Actor', 'actor_movie', 'movie_id', 'actor_id'); 
    }
    
    public function syncActors($actors)
    {
       $actorsIds = collect($actors)->map(function($actor){
            return  Actor::find($actor) ? $actor : Actor::create(['actor_name' => $actor])->id;
        });                

        return $this->actors()->sync($actorsIds);
    }
}
