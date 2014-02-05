@if ($paginator->getLastPage() > 1)
<ul>
      <a href="{{ $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><i><<</i>First </a>&nbsp;
      <a href="{{$paginator->getUrl($paginator->getCurrentPage()-1)}}"><i><</i>Previous</a>
<!--@for ($i = $paginator->getCurrentPage(); $i < $paginator->getLastPage(); $i++)
        
      <a href="{{ $paginator->getUrl($i) }}" class="item{{ ($paginator->getCurrentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
      @endfor-->
      <a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}">
    Next<i>></i>
</a>
&nbsp;
    <a href="{{$paginator->getUrl($paginator->getLastPage())}}">Last<i>>></i></a>
  
</ul>

@endif