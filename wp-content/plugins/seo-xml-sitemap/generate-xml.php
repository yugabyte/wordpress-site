<?php 
global $wpdb;
$createsitemap = get_posts(array('numberposts' => -1,'orderby' => 'modified','post_type'  => array('post','page','property','product'),'order'=> 'DESC'));
$seo_xml_sitemap .= '<?xml version="1.0" encoding="UTF-8"?>';
$seo_xml_sitemap .= "\n".'<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\n";
$seo_xml_sitemap .= "\t".'<url>'."\n".
"\t\t".'<loc>'. esc_url( home_url( '/' ) ) .'</loc>'.
"\n\t\t".'<changefreq>monthly</changefreq>'.
"\n\t\t".'<priority>1.0</priority>'.
"\n\t".'</url>'."\n";
foreach($createsitemap as $post){
	setup_postdata($post);
	$postdate = explode(" ", $post->post_modified);
	if(get_permalink($post->ID) != get_site_url()){
		$seo_xml_sitemap .= "\t".'<url>'."\n".
		"\t\t".'<loc>'. get_permalink($post->ID) .'</loc>'.
		"\n\t\t".'<changefreq>Weekly</changefreq>'.
		"\n\t\t".'<priority>0.5</priority>'.
		"\n\t".'</url>'."\n";
	} 
}
$seo_xml_sitemap .= '</urlset>';
$sitemapfp = fopen(ABSPATH . "sitemap.xml", 'w');
fwrite($sitemapfp, $seo_xml_sitemap);
fclose($sitemapfp);
?>