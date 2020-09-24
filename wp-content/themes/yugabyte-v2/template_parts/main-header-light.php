<nav class="navbar navbar-light justify-content-between" role="menu" id="myNav">
	<div class="container">
		<div class="nav-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">
				<img class="navWhite" src="/wp-content/uploads/2019/07/ybDB-Dark-v2.svg">
				<img class="navBlack" src="/wp-content/uploads/2019/07/ybDB-Dark-v2.svg">
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleNavClass()">
			<img class="icon-hamb" src="/wp-content/uploads/2018/08/hamburger-dark.svg">
			<img class="icon-cross" src="/wp-content/uploads/2018/08/hamburger-close.svg">
		</button>
		<div class="menu-container collapse navbar-collapse" id="main-navbar">
			<?php wp_nav_menu( array( 
				'theme_location' => 'header-menu',
				'depth'			 => 2,
				'container'		 => false,
				'menu_class'	 => 'nav',
				'fallback_cb'	 => 'WP_Bootstrap_Navwalker::fallback',
				'walker'		 => new WP_Bootstrap_Navwalker() 
			) ); ?>
		
			<div class="button-container">
				<a href="https://download.yugabyte.com" class="button secondary slide-in">
					<span class="text">Get Started</span>
				</a>
			</div>
		</div>
	</div>
</nav>