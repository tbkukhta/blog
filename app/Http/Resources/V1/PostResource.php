<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->when(Route::currentRouteName() != 'api.posts.index', $this->slug),
            'description' => $this->when(Route::currentRouteName() != 'api.posts.index', $this->description),
            'content' => $this->when(Route::currentRouteName() != 'api.posts.index', $this->content),
            'category' => $this->category->title,
            'tags' => $this->tags->pluck('title')->join(', '),
            'views' => $this->views,
            'status' => $this->status ? 'Active' : 'Disabled',
            'created' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
