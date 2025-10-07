<?php
function latest_version($file_path)
{
    echo $file_path . "?ver=" . time();
}