<?php

namespace App\Models\DataTransformers;

use App\Models\Event;

class EventDataTransformer
{

    public static function transformToApiList(Event $event): array
    {
        $creator = $event->user;

        return [
            'id' => $event->id,
            'title' => $event->title,
            'description' => $event->description,
            'created_at' => $event->created_at->format('d-m-Y'),
            'creator_name' => "{$creator->name} {$creator->surname}",
            'creator_id' => $creator->id,
            'participants' => $event->users->transform(UserDataTransformer::transformToList(...)),
        ];
    }
    public static function transformToList(Event $event): array
    {
        return [
            'id' => $event->id,
            'title' => $event->title,
        ];
    }

    public static function transformToDetail(Event $event): array
    {

        return [
            'id' => $event->id,
            'title' => $event->title,
            'description' => $event->description,
            'created_at' => $event->created_at->format('d-m-Y'),
            'user_id' => $event->user_id,
            'involve' => $event->users->find(auth()->id())?->id,
            'users' => $event->users->transform(UserDataTransformer::transformToList(...)),
        ];
    }
}