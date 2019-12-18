<nav class="navbar navbar-dark justify-content-between" role="menu" id="myNav">
	<div class="container">
		<div class="nav-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo-link">
				<img class="navWhite" src="/wp-content/uploads/2019/07/ybDB-Light-v2.svg">
				<img class="navBlack" src="/wp-content/uploads/2019/07/ybDB-Dark-v2.svg">
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleNavClass()">
			<img class="icon-hamb" src="/wp-content/uploads/2018/08/hamburger-white.svg">
			<img class="icon-cross" src="/wp-content/uploads/2018/08/hamburger-close.svg">
		</button>
		<div class="menu-container collapse navbar-collapse" id="main-navbar">
			<?php wp_nav_menu( array( 
				'theme_location'	=> 'header-menu',
				'depth'				=> 2,
				'container'			=> false,
				'menu_class'		=> 'nav',
				'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
				'walker'			=> new WP_Bootstrap_Navwalker() 
			) ); ?>
			<ul id="menu-main-menu" class="nav">
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-12 nav-item"><a title="Products" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link" id="menu-item-dropdown-12">Products</a>
					<ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-12" role="menu">
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1536" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1536 nav-item"><a title="Yugabyte Platform" href="https://www.yugabyte.com/platform/" class="dropdown-item">Yugabyte Platform</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1537" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1537 nav-item"><a title="Yugabyte Cloud" href="https://www.yugabyte.com/cloud/" class="dropdown-item">Yugabyte Cloud</a></li>
					</ul>
				</li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-601" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-601 nav-item"><a title="Open Source" href="https://www.yugabyte.com/yugabytedb/" class="nav-link">Open Source</a></li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-910" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-910 nav-item"><a title="Success Stories" href="https://www.yugabyte.com/success-stories" class="nav-link">Success Stories</a></li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-13 nav-item"><a title="Use Cases" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link" id="menu-item-dropdown-13">Use Cases</a>
					<ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-13" role="menu">
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-844" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-844 nav-item"><a title="Globally Distributed Applications" href="https://www.yugabyte.com/globally-distributed-applications/" class="dropdown-item">Globally Distributed Applications</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-841" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-841 nav-item"><a title="Real-Time Streaming &amp; Analytics" href="https://www.yugabyte.com/real-time-streaming-and-analytics/" class="dropdown-item">Real-Time Streaming &amp; Analytics</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-791" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-791 nav-item"><a title="Planet-Scale SQL" href="https://www.yugabyte.com/planet-scale-sql/" class="dropdown-item">Planet-Scale SQL</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-843" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-843 nav-item"><a title="Transactional NoSQL" href="https://www.yugabyte.com/transactional-nosql/" class="dropdown-item">Transactional NoSQL</a></li>
					</ul>
				</li>
				<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-908" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown menu-item-908 nav-item"><a title="Resources" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link" id="menu-item-dropdown-908">Resources</a>
					<ul class="dropdown-menu" aria-labelledby="menu-item-dropdown-908" role="menu">
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1034" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1034 nav-item"><a title="Blog" href="https://blog.yugabyte.com/" class="dropdown-item">Blog</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16 nav-item"><a title="Docs" href="https://docs.yugabyte.com/" class="dropdown-item">Docs</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1398" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1398 nav-item"><a title="Slack" href="http://yugabyte.com/slack" class="dropdown-item">Slack</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1540" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1540 nav-item"><a title="GitHub" href="https://github.com/YugaByte/yugabyte-db" class="dropdown-item">GitHub</a></li>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-1582" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1582 nav-item"><a title="Videos" href="https://vimeo.com/yugabyte" class="dropdown-item">Videos</a></li>
					</ul>
				</li>
				<hr />
			</ul>
			<div class="button-container">
				<a href="https://download.yugabyte.com" class="button secondary">
					<span class="text">Get Started</span>
				</a>
			</div>
		</div>
	</div>
</nav>