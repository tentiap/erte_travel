<?php

function cui_toolbar_btn_delete($url, $id, $icon, $text = null, $message = 'Anda yakin?')
{
    $str = Form::open([
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'id' => 'delete-form-toolbar',
        'url' => $url]);
    $str .= Form::hidden('id', $id);
    $str .= Form::close();

    return $str.'<button class="btn" href="'.$url.'" onclick="if(confirm(\''.$message.'\')){ document.getElementById(\'delete-form-toolbar\').submit(); }"> <i class="'.$icon.'"></i> &nbsp;'.$text.'</button>';
}

function cui_btn_delete($url, $message, $text = "")
{
    $str = Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('$message');",
        'url' => $url));
    $str .= Form::button('<i class="fa fa-trash"></i>'.$text, ['class' => 'btn btn-sm btn-outline-danger', 'type' => 'submit']);
    $str .= Form::close();

    return $str;
}