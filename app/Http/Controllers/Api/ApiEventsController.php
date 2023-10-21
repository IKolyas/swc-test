<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EventRequest;
use App\Http\Requests\Api\EventUpdateRequest;
use App\Http\Resources\EventCollection;
use App\Models\DataTransformers\EventDataTransformer;
use App\Models\DataTransformers\UserDataTransformer;
use App\Models\Event;
use App\Traits\SendResponse;
use Illuminate\Http\JsonResponse;

class ApiEventsController extends Controller
{
    use SendResponse;

    public function index(): JsonResponse
    {
        return $this->successResponse(new EventCollection(Event::paginate(2)));
    }

    public function store(EventRequest $request): JsonResponse
    {
        $event = auth()->user()->events()->create($request->validated());

        return $this->successResponse([
            'event' => EventDataTransformer::transformToList($event)
        ], 201);
    }

    public function update(EventUpdateRequest $request, Event $event): JsonResponse
    {
        $validated = $request->validated();

        $event->users()->toggle([$validated['user_id']]);

        return $this->successResponse([
            'event' => $event->users->transform(UserDataTransformer::transformToList(...))
        ], 201);
    }

    public function destroy(Event $event): JsonResponse
    {
        if (!$event->user?->id !== auth()->id()) {
            $this->failedResponse('You can not delete this event', 403);
        }

        $event->users()->detach();
        $event->delete();

        return $this->successResponse(['message' => 'Event deleted'], 204);
    }
}