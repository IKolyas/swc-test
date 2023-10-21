<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{$event['title']}}</h5>
        <p class="card-text">{{$event['description']}}</p>
        <p class="card-text">{{$event['created_at']}}</p>

        <div class="text-lg text-success mb-2 mt-2">Участники</div>
        <ul class="list-group mt-2 mb-2">
            @foreach($event['users'] as $user)
                <li class="list-group-item">
                    {{$user['fullName']}}
                </li>
            @endforeach
        </ul>
        <a href="{{
            $event['involve']
            ? route('events.detach', $event['id'])
            : route('events.attach', $event['id'])
            }}"
           class="card-link">{{$event['involve'] ? 'Отказаться от участия' : 'Принять участие'}}</a>
    </div>
</div>