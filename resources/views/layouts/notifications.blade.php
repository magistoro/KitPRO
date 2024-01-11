@foreach($notifications as $notification)
    {{-- <p>{{ $notification->title }}</p> --}}
    <a  onclick="window.location='{{ route('admin.sale.show', $notification->id) }}';" class="text-muted">Посмотреть</a>
    <button onclick="redirectToOrder('{{ route('admin.sale.show', '') }}/{{ $notification->id }}')">Посмотреть</button>
@endforeach