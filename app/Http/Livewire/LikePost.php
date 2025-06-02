<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likeCount;

    public function mount($post)
    {
        $this->post = $post;
        $this->isLiked = $this->post->isLikedByUser(auth()->user()->id);
        $this->likeCount = $this->post->likes()->count();
    }

    public function like()
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        if($this->post->isLikedByUser(auth()->user()->id)){
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
        }
        $this->likeCount = $this->post->likes()->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
