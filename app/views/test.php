<table border="1">
    <tr>
        <td>Rank</td>
        <td>Title</td>
        <td>Type</td>
        <td>URL</td>
    </tr>
    
    <?php
    $newArray = $results;
    $i =0;
    //print_r($results);
    //die();
      for($i=1;$i<count($newArray);$i++)
        { 
    ?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo $newArray[$i]['text']?></td>
        <td><?php echo $newArray[$i]['type']?></td>
        <td><?php echo $newArray[$i]['url']?></td>
    </tr>
    <?php
        }
    ?>
</table>