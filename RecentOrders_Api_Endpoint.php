<?php
/*
Plugin Name: RecentOrders API Endpoint
Description: https://gist.github.com/thenbrent/6514417
Version: 0.1
Usage: /?wc_recent_orders=<int>
Author: Andrey Kozhuhov
Author URL: http://www.cimpleo.com
*/

class RecentOrders_API_Endpoint{
	
	public function __construct(){
		add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );
		add_action( 'parse_request', array( $this, 'parse' ), 0 );
		add_action( 'init', array( $this, 'add_endpoint' ), 0 );
	}	

	public function add_query_vars( $vars ){
		$vars[] = 'wc_recent_orders';
		return $vars;
	}

	public function parse(){
		global $wp;
		if( isset( $wp->query_vars['wc_recent_orders'] ) ){
			$this->handle();
			exit;
		}
	}
	
	protected function handle(){
		global $wp;
		$count = $wp->query_vars['wc_recent_orders'];
		$count || $count = get_option( 'posts_per_page' );
		$this->response( '200 OK', $this->getRecentOrders( $count ) );
	}
	
	protected function getRecentOrders( $count )
	{		
		$args = array(
		'numberposts' => $count,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'shop_order',
		);

		$recent_posts = wp_get_recent_posts( $args );

		foreach ( $recent_posts as $post ) {
			$orders[] = new WC_Order( $post['ID'] );	
		}

		return $orders;
	}

	protected function response( $msg, $orders = '' ){
		$response['message'] = $msg;
		header( 'content-type: application/json; charset=utf-8' );
		echo json_encode( $orders ) . '\n';
		exit;
	}
}
new RecentOrders_API_Endpoint();
?>