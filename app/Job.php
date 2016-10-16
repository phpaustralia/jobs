<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    public $fillable = ['title', 'description'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function watchers()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function haversineQuery($latitude, $longitude, $radius, $page)
    {
        $items = self::select('jobs.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( lat ) )
                               * cos( radians( lng ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( lat ) ) )
                             ) AS distance,
                             count(id) as count
                             ', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])->get();

        $count = $items->count() == 0 ? 0 : $items[0]['count'];

        $jobs = self::select('jobs.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( lat ) )
                               * cos( radians( lng ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( lat ) ) )
                             ) AS distance
                             ', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])
            ->take(10)
            ->get();

        $baseUrl = "/api/v1/jobs/search?lat={$latitude}&lng={$longitude}&radius={$radius}&page=";

        $next = $page + 1;
        $last = ceil($count / 10);
        $nextUrl = $next >= $last ? null : url($baseUrl . $next);

        $prev = $page - 1;
        $prevUrl = $prev < 1 ? null : url($baseUrl . $prev);

        return collect([
            "total" => $count,
            "per_page" => 10,
            "current_page" => $page,
            "last_page" => $last ,
            "next_page_url" => $nextUrl,
            "prev_page_url" => $prevUrl,
            "from" => $page * 10 - 9,
            "to" => $page * 10,
            'data' => $jobs
        ]);
    }
}
