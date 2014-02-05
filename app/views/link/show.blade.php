{{HTML::link('/','Home')}}>{{HTML::link('link','Links')}}
<table border="1">
    <tr>
        <td>Rank</td>
        <td>Title</td>
        <td>URL</td>
    </tr>
    
    <?php
        foreach($results as $i=>$result)
        {           
    ?>
    <tr>
        <td><?php echo $i+1?></td>
        <td><?php echo $result['title']?></td>        
        <td>{{HTML::link('anchor/show/'.$result['id'],$result['url'])}}</td>
    </tr>
    <?php
        }
    ?>
</table>