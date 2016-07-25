<?php

namespace App\Models\Collections;

use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    /**
     * @param int $user_id
     * @return mixed
     */
    public function groupByCorrespondent($user_id)
    {
        $conversations = $this->reduce(function($carry, $message) use ($user_id) {
            if($user_id != $message->sender->id) {
                $message->side = 'left';
                $carry[$message->sender->id]['id'] = $message->sender->id;
                $carry[$message->sender->id]['name'] = $message->sender->name;
                $carry[$message->sender->id]['messages'][]  = $message;
                return $carry;
            }
            $message->side = 'right';
            $carry[$message->receiver->id]['id'] = $message->receiver->id;
            $carry[$message->receiver->id]['name'] = $message->sender->name;
            $carry[$message->receiver->id]['messages'][]  = $message;

            return $carry;
        });

        if(!$conversations) {
            return [];
        }
        
        return $conversations;
    }
}