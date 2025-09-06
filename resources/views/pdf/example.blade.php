<h1 class="font-2xl">Timesheets</h1>

<table>
    <thead>
        <th>Calendario</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Día</th>
    </thead>
    <tbody>
        @foreach ($holidays as $item)
        <tr>
            <td>{{ $item->calendar->name }}</td>
            <td>{{ $item->user->name }}</td>    
            <td>{{ $item->type }}</td>
            <td>{{ $item->day }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
