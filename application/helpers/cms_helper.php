<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/8/18
 * Time: 11:13 AM
 */

function btn_edit($uri){
    return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete($uri){
        return anchor($uri, '<i class="icon-remove"></i>', array(
            'onclick' => "return confirm('You are about to delete a record. This cannot be undone."
        ));
}

function project_link($project){
    $url = 'project/' . intval($project->id) . '/' . e($project->slug);
    return $url;
}

 function console_log($data){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}


function project_links($projects){
    $string = '<ul>';
    console_log($projects);

    foreach ($projects as $project){
        $url = project_link($project);
        $string .= '<li><h4 class="sidebar-link">' . anchor($url, e($project->title)) . '</h4> </li>';
        $string .= get_deadline_funded($project);

    }

    $string .= '</ul>';

    return $string;

}

function get_daysleft($project){
    //Deadline
    $future = strtotime($project->deadline); //Future date.
    $days = round(($future - time()) / 86400);

    return $days;
}

function get_backers_pledged($project){
    $string = '';
    $string .= '<p class="deadline">'  . '$'. e($project->pledged). ' pledged' . ' of ' .'$'. e($project->goal) .'</p>';

    $string .= '<p class="deadline">'  . e($project->backers). ' backers' . '</p>';

    return $string;
}

function get_deadline_funded($project){
    $string = '';
    $string .= '<p class="deadline">' . 'Days Left : ' . e(get_daysleft($project)) . '</p>';

    //Funded
    $goal = $project->goal;
    $pledged = $project->pledged;
    $funded = ($pledged*100) / $goal ;
    $string .= '<p class="deadline">'  . e($funded). '% funded' . '</p>';

    return $string;
}


function get_excerpt($project, $numwords = 20){
    $string = '';
    $url = 'project/' . intval($project->id) . '/' . e($project->slug);

    $string .= get_deadline_funded($project);
    $string .= '<p>' .  e(limit_to_numwords(strip_tags($project->body), $numwords)) . '</p>';

    $string .= '<p>' . anchor($url, 'Read More >', array('title' => e($project->title)))  . '</p>';

    return $string;
}

function limit_to_numwords($string, $num){
    $excerpt = explode(' ', $string, $num+1);
    if (count ($excerpt) >= $num){
        array_pop($excerpt);
    }

    $excerpt = implode(' ', $excerpt);
    return $excerpt;
}

//filter input escape output
function e ($string){
    return htmlentities($string);
}

function filter_alive($projects){
    $filtered = array();
    foreach ($projects as $project){
        if (get_daysleft($project) > 0){
            array_push($filtered, $project);
        }
    }

    return $filtered;
}

function filter_category($projects){
    $filtered = array();
    foreach ($projects as $project){
        if ($project->category == get_instance()->uri->segment(1)){
            array_push($filtered, $project);
        }
    }

    return $filtered;
}

function get_menu($arr, $child = FALSE)
{
    $CI =& get_instance();
    $str = '';
    if (count($arr)) {
        $str .= $child == FALSE ? '<ul class = "nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

        foreach ($arr as $item) {

            $active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
            echo "<script>console.log( 'Debug Objects: " . $active . " and " . $CI->uri->segment(1) . "' );</script>";

            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a class="dropdown-toggle" data-toggle="dropdown" href=" ' . site_url(e($item['slug'])) . '">' . e($item['title']);
                $str .= '<b class="caret"> </b></a>' . PHP_EOL;
                $str .= get_menu($item['children'], TRUE);

            } else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href=" ' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
            }


            $str .= '</li>' . PHP_EOL;
        }
        $str .= '</ul>' . PHP_EOL;

    }
    return $str;
}

function get_recent($projects, $limit = 3){
    $limit = (int)$limit;
    $projects = filter_alive($projects);

    usort($projects, "date_sort");
    return $projects;
}

function date_sort($a, $b) {
    return strtotime($a->deadline) - strtotime($b->deadline);
}
/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

