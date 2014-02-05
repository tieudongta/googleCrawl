<?php
    echo Form::open(array('action'=>'KeywordController@show'));
    echo Form::label('keyword','Keyword');
    echo Form::text('keyword');
    echo Form::submit('Submit');
    echo Form::close();
?>