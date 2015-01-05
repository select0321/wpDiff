
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="zh-CN">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="zh-CN">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>修订版本 &lsaquo; mylib &#8212; WordPress</title>

<link rel='stylesheet' href='./load-styles.css' type='text/css' />

</head>
<body>
<div class="revisions-diff-frame"><div class="revisions-diff">
	<div class="loading-indicator"><span class="spinner"></span></div>
	<div class="diff-error">抱歉，发生了错误。无法加载请求的比较。</div>
	<div class="diff">
	
		<h3>标题</h3>
		<table class="diff"><colgroup><col class="content diffsplit left"><col class="content diffsplit middle"><col class="content diffsplit right"></colgroup><tbody><tr><td>rss阅读</td><td></td><td>rss阅读</td></tr></tbody></table>
	
		<h3>内容</h3>
<?php
require( './functions.php' );
require( './formatting.php' );
require( './plugin.php' );
$str1 = file_get_contents('D:\wamp\logs\xdebug_log\lk1.html');
$str2 = file_get_contents('D:\wamp\logs\xdebug_log\lk2.html');
echo wp_text_diff($str1, $str2);
/**
 * Displays a human readable HTML representation of the difference between two strings.
*
* The Diff is available for getting the changes between versions. The output is
* HTML, so the primary use is for displaying the changes. If the two strings
* are equivalent, then an empty string will be returned.
*
* The arguments supported and can be changed are listed below.
*
* 'title' : Default is an empty string. Titles the diff in a manner compatible
*		with the output.
* 'title_left' : Default is an empty string. Change the HTML to the left of the
*		title.
* 'title_right' : Default is an empty string. Change the HTML to the right of
*		the title.
*
* @since 2.6.0
*
* @see wp_parse_args() Used to change defaults to user defined settings.
* @uses Text_Diff
* @uses WP_Text_Diff_Renderer_Table
*
* @param string $left_string "old" (left) version of string
* @param string $right_string "new" (right) version of string
* @param string|array $args Optional. Change 'title', 'title_left', and 'title_right' defaults.
* @return string Empty string if strings are equivalent or HTML with differences.
*/
function wp_text_diff( $left_string, $right_string, $args = array('show_split_view' => true) ) {
    $defaults = array( 'title' => '', 'title_left' => '', 'title_right' => '' );
    $args = wp_parse_args( $args, $defaults );

    if ( !class_exists( 'WP_Text_Diff_Renderer_Table' ) )
        require( './wp-diff.php' );

    $left_string  = normalize_whitespace($left_string);
    $right_string = normalize_whitespace($right_string);

    $left_lines  = explode("\n", $left_string);
    $right_lines = explode("\n", $right_string);
    $text_diff = new Text_Diff($left_lines, $right_lines);
    $renderer  = new WP_Text_Diff_Renderer_Table( $args );
    $diff = $renderer->render($text_diff);

    if ( !$diff )
        return '';

    $r  = "<table class='diff'>\n";

    if ( ! empty( $args[ 'show_split_view' ] ) ) {
        $r .= "<col class='content diffsplit left' /><col class='content diffsplit middle' /><col class='content diffsplit right' />";
    } else {
        $r .= "<col class='content' />";
    }

    if ( $args['title'] || $args['title_left'] || $args['title_right'] )
        $r .= "<thead>";
    if ( $args['title'] )
        $r .= "<tr class='diff-title'><th colspan='4'>$args[title]</th></tr>\n";
    if ( $args['title_left'] || $args['title_right'] ) {
        $r .= "<tr class='diff-sub-title'>\n";
        $r .= "\t<td></td><th>$args[title_left]</th>\n";
        $r .= "\t<td></td><th>$args[title_right]</th>\n";
        $r .= "</tr>\n";
    }
    if ( $args['title'] || $args['title_left'] || $args['title_right'] )
        $r .= "</thead>\n";

    $r .= "<tbody>\n$diff\n</tbody>\n";
    $r .= "</table>";
   
    return $r;
}
?>
	
	</div>
</div></div>

</body>
</html>