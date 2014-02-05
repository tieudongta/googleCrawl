{{HTML::link('/','Home')}}>{{HTML::link('link','Links')}}
<h1>Anchors list</h1>
@if($anchors)
<h3>Anchors found: {{count($total)}}</h3>
<table border="1">
    
    <thead><td>Text</td><td>Type</td><td>Link Title</td><td>Created date</td></thead>
    @foreach($anchors as $anchor)
    <tr><td>{{$anchor->anchor_text}}</td><td>{{$anchor->anchor_type}}</td><td>{{$anchor->link->title}}</td><td>{{$anchor->created_at}}</td></tr>
    @endforeach
    
</table>
@else
<h2>We have no anchors yet</h2>
@endif
{{$anchors->links('structures/paginator')}}