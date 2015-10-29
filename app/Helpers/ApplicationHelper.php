<?php

if( ! function_exists('limit_to_numwords'))
{
    /**
     * Limit content with number of words
     *
     * @param $string
     * @param $numwords
     * @return array|string
     */
    function limit_to_numwords($string, $numwords)
    {
        $excerpt = explode(' ', $string, $numwords + 1);
        if (count($excerpt) >= $numwords)
        {
            array_pop($excerpt);
        }
        $excerpt = implode(' ', $excerpt) . ' ...';
        return $excerpt;
    }
}

if( ! function_exists('renderCarousel')) {
    function renderCarousel($data_target, $left_icon, $right_icon, $left_label, $right_label)
    {
        $carousel = Session::get('current_lang')->carousels;
        $html = '';
        $indicator = '';
        $slides = '';
        $carousel_indicators = 'class="carousel-indicators"';
        $carousel_inner = 'class="carousel-inner" role="listbox"';
        $carousel_right_control = 'class="right carousel-control" href="' . $data_target .'" role="button" data-slide="next"';
        $carousel_left_control = 'class="left carousel-control" href="' . $data_target .'" role="button" data-slide="prev"';
        if ($carousel) {
            // Collecting carousel indicators, slide images
            $indicator .= '<ol ' . $carousel_indicators . '>';
            $slides .= '<div ' . $carousel_inner . '>';
            $counter = 0;
            foreach($carousel as $img) {
                if($counter == 0) {
                    $indicator .= '<li data-target="' . $data_target . '" data-slide-to="' . $counter . '" class="active"></li>';
                    $slides .= '<div class="item active"><img src="' . $img->image . '" alt="' . $img->title . '"></div>';
                }
                else {
                    $indicator .= '<li data-target="' . $data_target . '" data-slide-to="' . $counter . '"></li>';
                    $slides .= '<div class="item"><img src="' . $img->image . '" alt="' . $img->title . '"></div>';
                }
                $counter++;
            }
            $indicator .= '</ol>';
            $slides .= '</div>';
        }
        $carousel_right_control =   '<a ' . $carousel_right_control . '>' .
            '<span class="' . $right_icon . '" aria-hidden="true"></span>' .
            '<span class="sr-only">' . $right_label . '</span></a>';
        $carousel_left_control =   '<a ' . $carousel_left_control . '>' .
            '<span class="' . $left_icon . '" aria-hidden="true"></span>' .
            '<span class="sr-only">' . $left_label . '</span></a>';
        $html = $indicator . $slides . $carousel_left_control . $carousel_right_control;
        return $html;
    }
}

if( ! function_exists('renderMenuNode')) {
    /**
     * Render nodes for nested sets
     *
     * @param $node
     * @return string
     */
    function renderMenuNode($node)
    {
        $list = 'class="dropdown-menu"';
        $class = 'class="dropdown"';
        $caret = '<i class="fa fa-caret-down"></i>';
        $link = route('page', ['id' => $node->id]);
        $drop_down = '<a class="dropdown-toggle" data-toggle="dropdown" href="'.$link.'" role="button" aria-expanded="false">' . $node->title . ' ' . $caret . '</a>';
        $single  = '<a href="'. $link .'">' . $node->title . '</a>';
        if ($node->isLeaf())
        {
            return '<li>' . $single . '</li>';
        }
        else
        {
            $html = '<li '.$class.'>' . $drop_down;
            $html .= '<ul '.$list.'>';
            foreach ($node->children as $child)
            {
                $html .= renderMenuNode($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        return $html;
    }
}

if( ! function_exists('getTitle')) {
    /**
     * Render nodes for nested sets
     *
     * @param $object
     * @return string
     */
    function getTitle($object = null)
    {
        return isset($object) && isset($object->title) ? $object->title . ' | ' .  Session::get('current_lang')->site_title : Session::get('current_lang')->site_title;
    }
}

if( ! function_exists('getDescription')) {
    /**
     * Render nodes for nested sets
     *
     * @param $object
     * @return string
     */
    function getDescription($object = null)
    {
        return isset($object) && isset($object->description) ? $object->description : Session::get('current_lang')->site_description;
    }
}