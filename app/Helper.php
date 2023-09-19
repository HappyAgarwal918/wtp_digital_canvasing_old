<?php
function SLGenerator($data){
    return ($data->perPage() * $data->currentPage()) - ($data->perPage() - 1);
}
