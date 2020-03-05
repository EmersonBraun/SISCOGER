<table id="{{$id ?? 'datable'}}" class="table {{$class ?? 'table-bordered table-striped datable'}}">
    <thead>
        <tr>
            @isset($id)    
                <th style="display: none">{{'id_'.$id}}</th>
            @endisset
            @foreach ($rows as $r)
                <th class='col-lg-{{$r['lg'] ?? '4'}} col-md-{{$r['md'] ?? '4'}} col-xs-{{$r['xs'] ?? '4'}}'>{{$r['text']}}</th>
            @endforeach  
        </tr>
    </thead>
    <tbody>
        {{$slot}}
    </tbody>
    <tfoot>
        <tr>
            @isset($id)    
                <th style="display: none">{{'id_'.$id}}</th>
            @endisset
            @foreach ($rows as $r)
                <th class='col-lg-{{$r['lg'] ?? '4'}} col-md-{{$r['md'] ?? '4'}} col-xs-{{$r['xs'] ?? '4'}}'>{{$r['text']}}</th>
            @endforeach 
        </tr>
    </tfoot>
</table>