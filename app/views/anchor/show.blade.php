{{HTML::link('/','Home')}}>{{HTML::link('link','Links')}}>{{HTML::link('anchor','Anchors')}}
<h1>Anchors list</h1>
URL: <a href="{{$link->url}}">{{$link->url}}</a><br>
<table border="1">
    <tr>
        <td>Title</td>
        <td>{{$link->title}}</td>
    </tr>
    <tr>
        <td>Meta description</td>
        <td>{{$link->meta_info}}</td>
    </tr>
</table><br><br>
@if($anchors)
<table border="1">
    
    <thead>
    <td>ID</td>
    <td>Anchor Text</td>
    <td>Anchor Type</td>
    <td>Anchor URL</td>
</thead>
    @foreach($anchors as $anchor)
    <tr>
        <td>{{$anchor->id}}</td>
        <td>{{$anchor->anchor_text}}</td>
        <td>{{$anchor->anchor_type}}</td>
        <td>{{$anchor->anchor_url}}</td>
        
    </tr>
    @endforeach
</table>
@else
<h2>We have no anchors yet</h2>
@endif
{{$anchors->links('structures/paginator')}}