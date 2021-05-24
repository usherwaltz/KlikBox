<div>
    <h1>Napravljena nova narudzba</h1>
    <p>Narudzba {{$id}}</p>
    <table cellpadding="10" border="1" align="center">
        <thead>
        <tr>
            <th>Datum</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Grad</th>
            <th>Adresa</th>
            <th>Poštanski broj</th>
            <th>Email</th>
            <th>Broj telefona</th>
            <th>Proizvod/i</th>
            <th>Količina/e</th>
            <th>Cijena/e</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ date('d.m.Y H:i:s', strtotime($order->updated_at)) }}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->lastname}}</td>
                <td>{{$order->city}}</td>
                <td>{{$order->street}}</td>
                <td>{{$order->postcode}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->phone}}</td>
                <td>
                    @foreach($items as $item)
                        {{$item->name}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($items as $item)
                        {{$item->qty}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($items as $item)
                        {{$item->price}} <br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
