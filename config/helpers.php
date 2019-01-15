<?php

if (!function_exists('getPaging')) {
    function getPaging(
        $num_rows = 0,
        $per_page = 10,
        $frmID = '#gridForm',
        $action = "",
        $parameter_name = 'page',
        $show_first_last = true
    ) {
        if (!($num_rows > 0)) {
            return "";
        }

        //neu $action chua {i} thi action do user dat, neu khong tu sinh action
        $query_string = "";
        if ($action != "" && stripos($action, "{i}") === false && $_SERVER['QUERY_STRING'] != '') {
            $queries = $_SERVER['QUERY_STRING'];
            $queries = explode("&", $queries);
            foreach ($queries as $query) {
                $arr = explode("=", $query);
                if ($arr[0] != "_url" && $arr[0] != $parameter_name) {
                    $query_string .= "{$arr[0]}=" . (isset($arr[1]) ? $arr[1] : "") . "&";
                }
            }

            $action = "?{$query_string}#{$parameter_name}{i}";
        }

        $limit_page = 4;

        $current_page = isset($_REQUEST[$parameter_name]) ? $_REQUEST[$parameter_name] : 1;

        $total_page = ceil($num_rows / $per_page); //tong pages

        $page_line = "";
        $page_line .= '<ul class="pagination pagination-split" style="display: inline-block;">';

        $start_page = 1;
        if ($current_page > ($limit_page / 2)) {
            $start_page = $current_page - (int)($limit_page / 2);
        }
        if ($total_page - $start_page < $limit_page) {
            $start_page = $total_page - $limit_page;
        }
        if ($start_page < 1) {
            $start_page = 1;
        }

        $end_page = $start_page + $limit_page;
        //if($start_page<)
        if ($end_page > $total_page) {
            $end_page = $total_page;
        }

        if (($show_first_last) && ($start_page > 1)) {
            $page_line .= '<li><a class="page-link" href="' . str_replace("{i}", "1",
                    $action) . '" onclick="$(\'' . $frmID . '\').trigger(\'submit\', [' . (1) . ']); return false;"><i class="fa fa-angle-double-left"></i></a></li>';
        }

        if ($start_page > 1) {
            $page_line .= '<li><a class="page-link" href="' . str_replace("{i}", $start_page - 1,
                    $action) . '" onclick="$(\'' . $frmID . '\').trigger(\'submit\', [' . ($start_page - 1) . ']); return false;"><i class="fa fa-angle-left"></i></a></li>';
        }

        // pages
        for ($i = $start_page; $i <= $end_page; $i++) {
            if ($i > $end_page) {
                break;
            }
            if ($current_page != $i) {
                $page_line .= '<li class="page-item"><a class="page-link" href="' . str_replace("{i}", $i,
                        $action) . '" onclick="$(\'' . $frmID . '\').trigger(\'submit\', [' . ($i) . ']); return false;">' . $i . '</a></li>';
            } else {
                $page_line .= '<li class="page-item active"><a class="page-link" href="" onclick="return false;">' . $i . '</a></li>';
            }
        }

        // arrow next
        if ($total_page > $end_page) {
            $page_line .= '<li><a class="page-link" href="' . str_replace("{i}", $end_page + 1,
                    $action) . '" onclick="$(\'' . $frmID . '\').trigger(\'submit\', [' . ($end_page + 1) . ']); return false;"><i class="fa fa-angle-right"></i></a></li>';
        }

        // arrow last
        if (($show_first_last) && ($total_page > $end_page)) {
            $page_line .= '<li><a class="page-link" href="' . str_replace("{i}", $total_page,
                    $action) . '" onclick="$(\'' . $frmID . '\').trigger(\'submit\', [' . ($total_page) . ']); return false;"><i class="fa fa-angle-double-right"></i></a></li>';
        }

        $page_line .= '</ul>';
        return $page_line;
    }
}

if (!function_exists('unlinkUpload')) {
    function unlinkUpload($path, $name)
    {
        @unlink(public_path('uploads/' . $path . '/' . $name));
        @unlink(public_path('uploads/' . $path . '/thumb_' . $name));
    }
}
