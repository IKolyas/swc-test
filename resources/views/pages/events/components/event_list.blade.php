<div class="d-flex flex-column mb-2">
    <div class="text-lg text-success mb-1">
        {{$title}}
    </div>
    <div class="list-group">
        @foreach($events as $event)
            <a href="{{route('events.index', ['event' => $event['id']])}}"
               class="list-group-item list-group-item-action {{$active == $event['id'] ? 'active' : ''}}" aria-current="{{$active == $event['id']}}">
                {{$event['title']}}
            </a>
        @endforeach
    </div>
</div>


