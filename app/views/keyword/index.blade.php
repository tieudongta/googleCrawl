
<div>{{HTML::link('/','Home')}}>{{HTML::link('link','Links')}}</div>
<div style="float: left">
    <h1>Keyword input form</h1>
{{Form::open()}}
{{Form::textarea('keyword')}}<br>
{{Form::submit('Regist')}}
{{Form::close()}}

</div>
<div style="float: left; margin-left: 30px">
<h1>Keyword list</h1>
@if($keywords)
<table border="1">
    
    <thead>
        <td>ID</td>
        <td>Keyword</td>
        <td>Input date</td>
        <td>Status</td>
    </thead>
    <?php $count=1?>
    @foreach($keywords as $keyword)
    <tr>
        <td>{{$keyword->id}}</td>
        <td>{{$keyword->keyword}}</td>
        <td>{{$keyword->created_at->format('d/m/Y')}}</td>
        <td>{{HTML::link('link/linklist/'.$keyword->id,'Done')}}</td>
    </tr>
    @endforeach
</table>
@else
<h2>We have no keywords yet</h2>
@endif

</div>
