@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            <div class="d-flex flex-column m-2">
                <div id="event-list">
                    @include('pages.events.components.event_list', [
        'events' => $eventList,
        'title' => 'Все события',
        'active' => !empty($event['id']) ? $event['id'] : null
        ])
                </div>

                @include('pages.events.components.event_list', [
    'events' => $userEvents,
    'title' => 'Мои события',
    'active' => null
    ])
            </div>
            <div id="event-detail" class="d-flex flex-column m-2">
                @if(!empty($event))
                    @include('pages.events.components.event_detail', ['event' => $event])
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const eventList = document.getElementById('event-list');
            const eventDetail = document.getElementById('event-detail');

            setInterval(() => {
                axios.get('{{ route('events.reload', ['event' => empty($event) ?: $event['id']]) }}').then(resp => {
                    if (eventList) {
                        eventList.innerHTML = resp.data.eventList;
                    }

                    if (eventDetail && eventDetail.children.length) {
                        eventDetail.innerHTML = resp.data.event;
                    }
                }).catch(() => {
                    window.location.href = '{{ route('events.index') }}';
                })
            }, 30000)
        })
    </script>
@endpush