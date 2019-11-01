<?php
/*
Plugin Name: SEO XML SITEMAP 
Plugin URI:  https://www.maczin.com.au/
Description: After Active plugin Go To admin Menu => SEO SITEMP
Version: 1.0
Author: MacZin Team
Author URI: http://www.maczin.com.au/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
function maczin_sitemap( $atts ){
	$sitemap = "";
	$postsForSitemap = get_posts(array('numberposts' => -1,'orderby' => 'modified','post_type'  => array('page'),'order'=> 'DESC'));
	$sitemap .= '<h2>Pages</h2>';
	$sitemap .= "<hr/>";
	foreach($postsForSitemap as $post){
		setup_postdata($post);
		$postdate = explode(" ", $post->post_modified);
		$sitemap .= '<a  href="'. get_permalink($post->ID) .'" >'. $post->post_title.'</a>';
		$sitemap .= "<br/>";
	}
	$postsForSitemap2 = get_posts(array('numberposts' => -1,'orderby' => 'modified','post_type'  => array('post'),'order'=> 'DESC'));
	$sitemap .= '<h2>Pots</h2>';
	$sitemap .= "<hr/>";
	foreach($postsForSitemap2 as $post){
		setup_postdata($post);
		$postdate = explode(" ", $post->post_modified);
		$sitemap .= '<a  href="'. get_permalink($post->ID) .'" >'. $post->post_title.'</a>';
		$sitemap .= "<br/>";
	}
	$postsForSitemap3 = get_posts(array('numberposts' => -1,'orderby' => 'modified','post_type'  => array('product'),'order'=> 'DESC'));
	$sitemap .= '<h2>products</h2>';
	$sitemap .= "<hr/>";
	foreach($postsForSitemap3 as $post){
		setup_postdata($post);
		$postdate = explode(" ", $post->post_modified);
		$sitemap .= '<a  href="'. get_permalink($post->ID) .'" >'. $post->post_title.'</a>';
		$sitemap .= "<br/>";
	}
	return $sitemap;
}
add_shortcode( 'maczin_sitemap', 'maczin_sitemap' );

add_action( 'admin_menu', 'seo_xml_sitemap_menu' );
function seo_xml_sitemap_menu(){
	add_menu_page( 'SEO SITEMAP', 'SEO SITEMAP', 'manage_options', 'generate-xml.php', 'seo_admin_page',plugins_url( 'sitemap.png', __FILE__ ), 6  );
}
function seo_admin_page(){
	?>
	<div class="wrap">
		<h2>SEO XML SITEMAP</h2>
	</div>
	<div style="padding: 18px;background: white;">
	<h2>XML Sitemap</h2>
		<?php
		if(isset($_GET['action']) && $_GET['action'] == 'create'){
			include("generate-xml.php");
			?>
			<h2>XML Sitemap Sucessfull Generate..</h2>
			<h3><a href="<?php echo get_site_url(); ?>/sitemap.xml" style="color: green;" target="_blank" >View XML Sitemap</a></h3>
			<?php } 	?>
		<h3><a href="admin.php?page=generate-xml.php&action=create">Generate XML Sitemap</a></h3>
	</div>
<div style="padding: 18px;    margin-top: 12px; background: white;">
<h2>PAGE Sitemap</h2><h3>Put This <strong>[maczin_sidebar]</strong> Shortcode in Any Page.</h3>
</div>
<div style="padding: 18px;    margin-top: 12px; background: white;">
<h2>Origin</h2>
<p><strong>SEO XML Sitemap</strong> it has been programmed from the <a href="https://maczin.com.au">MacZin</a> Team.</p>
<h3>Our Services </h3>
<ul>
	<li><a href="https://maczin.com.au/" title="SEO Melbourne" target="_blank" >SEO Melbourne</a></li>
	<li><a href="https://maczin.com.au/seo-sydney/" target="_blank" title="SEO Company Sydney" >SEO Company Sydney</a></li>
	<li><a href="https://maczin.com.au/search-engine-marketing-melbourne/" title="Search engine marketing" target="_blank"  >Search engine marketing</a></li>	
	<li><a href="https://maczin.com.au/web-design-melbourne/" title="Web Design Melbourne" target="_blank">Web Design Melbourne</a></li>
	<li><a href="https://maczin.com.au/web-development-melbourne/" title="web Development Melbourne" target="_blank" >web Development Melbourne</a></li>
	<li><a href="http://domains.maczin.com.au/" title="Domain And Hosting Provider">Domain And Hosting Provider</a></li>		
</ul>
</div>
<?php
}