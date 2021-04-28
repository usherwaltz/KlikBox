<div>
    <h1>Napravljena nova narudzba</h1>
    <p>Narudzba {{$id}}</p>
    <table>
        <tr>
            <th>Ime</th>
            <td>{{$order->name}}</td>
        </tr>
        <tr>
            <th>Prezime</th>
            <td>{{$order->lastname}}</td>
        </tr>
        <tr>
            <th>Broj telefona</th>
            <td>{{$order->phone}}</td>
        </tr>
    </table>
    <a href="{{route('orders.show',$id)}}" class="btn btn-sm btn-primary">
        Pregled
        </a>
</div>