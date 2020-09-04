<h1> index</h1>
<table>
    @foreach($categorias as $categoria )
        <tr>
            <td>
                {{$categoria->id}}
            </td>
            <td>
                {{$categoria->nombre}}
            </td>

        </tr>
        @endforeach
</table>
