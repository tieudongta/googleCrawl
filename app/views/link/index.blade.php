{{HTML::link('/','Home')}}>{{HTML::link('anchor','Anchors')}}
<h1>Link list</h1>
@if($links)
<table border="1">
    
    <thead>
    <td>Rank</td>
    <td>Title</td>
    <td>URL</td>
    
</thead>

    @foreach($links as $k => $link)
    
    <tr>
        <td>{{$k+1}}</td>
        <td>{{$link->title}}</td>
        <td>{{HTML::link('anchor/show/'.$link->id,$link->url)}}</td>
    </tr>
    @endforeach
    
</table>
@else
<h2>We have no links yet</h2>
@endif
{{$links->links('structures/paginator')}}