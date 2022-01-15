<?php
/**
 * Change WP-Pagenavi's output
 *
 * @package hametuha
 * @filter wp_pagenavi
 * @param string $html
 * @return string
 * http://www.snip2code.com/Snippet/72981/WordPress-WP-Pagenavi---HTML-Twitter-Boo
 */
add_filter( 'wp_pagenavi', function($html){
    // Remove div.
    $html = trim(preg_replace('/<\/?div([^>]*)?>/u', '', $html));
    // Wrap links with li.
    $html = preg_replace('/(<a[^>]*>[^<]*<\/a>)/u', '<li>$1</li>', $html);
    // Wrap links with span considering class name.
    $html = preg_replace_callback('/<span([^>]*?)>[^<]*<\/span>/u', function($matches){
        if( false !== strpos($matches[1], 'current') ){
            // This is current page.
            $class_name = 'active';
        }elseif( false !== strpos($matches[1], 'pages') ){
            // This is page number.
            $class_name = 'hidden';
        }elseif( false !== strpos($matches[1], 'extend') ){
            // This is ellipsis.
            $class_name = 'disabled';
        }else{
            // No class.
            $class_name = '';
        }
        return "<li class=\"{$class_name}\">{$matches[0]}</li>";
    }, $html);
    // Wrap with ul as you like.
    return <<<HTML
<div class="row text-center">
    <ul class="pagination pagination-centered">{$html}</ul>
</div>
HTML;
}, 10, 2 );
?>