<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
if(!function_exists("wp_get_theme")){
	class WPGetThemePatch{var $Name, $ThemeURI, $Description, $Author, $AuthorURI, $Version, $Template, $Status, $Tags, $TextDomain, $DomainPath;var $arrTheme = array();
		function WPGetThemePatch(){
			$this->arrTheme = get_theme_data(dirname( __FILE__ )."/style.css");
			$this->Name =  $this->arrTheme["Name"];
			$this->ThemeURI =  $this->arrTheme["ThemeURI"];
			$this->Description =  $this->arrTheme["Description"];
			$this->Author =  $this->arrTheme["Author"];
			$this->AuthorURI =  $this->arrTheme["AuthorURI"];
			$this->Version =  $this->arrTheme["Version"];
			$this->Template =  $this->arrTheme["Template"];
			$this->Status =  $this->arrTheme["Status"];
			$this->Tags =  $this->arrTheme["Tags"];
			$this->TextDomain =  $this->arrTheme["TextDomain"];
			$this->DomainPath =  $this->arrTheme["DomainPath"];
		}
		function get($param){return $this->arrTheme[$param];}
	}
	function wp_get_theme(){$obj = new WPGetThemePatch;return $obj;}
}

    $theme = new Themater('Daxy');
    $theme->options['includes'] = array('featuredposts');
    
    $theme->options['plugins_options']['featuredposts'] = array('image_sizes' => '460px. x 300px.', 'speed' => '400', 'effect' => 'scrollHorz');

    if($theme->is_admin_user()) {
        $theme->admin_options['Ads']['content']['header_banner']['content']['value'] = '';
    }
    
    // Footer widgets
    $theme->admin_option('Layout', 
        'Footer Widgets Enabled?', 'footer_widgets', 
        'checkbox', 'true', 
        array('display'=>'extended', 'help' => 'Display or hide the 3 widget areas in the footer.', 'priority' => '15')
    );


    $theme->load();
    
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'themater'),
        'id' => 'sidebar_primary',
        'description' => __('The primary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    
    $theme->add_hook('sidebar_primary', 'sidebar_primary_default_widgets');
    
    function sidebar_primary_default_widgets ()
    {
        global $theme;

        $theme->display_widget('Text', array('text' => '<div style="text-align:center;"></div>'));
        $theme->display_widget('Tabs');
        $theme->display_widget('SocialProfiles');
        $theme->display_widget('Facebook', array('url'=> 'http://www.facebook.com/WordPress'));
        $theme->display_widget('Search');
        $theme->display_widget('Tag_Cloud');
        $theme->display_widget('Calendar', array('title' => 'Calendar'));
        
    }
    
    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'themater'),
        'id' => 'sidebar_secondary',
        'description' => __('The secondary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    $theme->add_hook('sidebar_secondary', 'sidebar_secondary_default_widgets');
    
    function sidebar_secondary_default_widgets ()
    {
        global $theme;
    
    $theme->display_widget('Pages');
    $theme->display_widget('Categories');
    $theme->display_widget('Archives');
    $theme->display_widget('Text', array('text' => '<div style="text-align:center;"></div>'));
    $theme->display_widget('Recent_Comments');
    $theme->display_widget('Links');
    $theme->display_widget('Meta');
    
    }
    
    // Register the footer widgets only if they are enabled from the FlexiPanel
    if($theme->display('footer_widgets')) {
        register_sidebar(array(
            'name' => 'Footer Widget Area 1',
            'id' => 'footer_1',
            'description' => 'The footer #1 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 2',
            'id' => 'footer_2',
            'description' => 'The footer #2 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 3',
            'id' => 'footer_3',
            'description' => 'The footer #3 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 4',
            'id' => 'footer_4',
            'description' => 'The footer #4 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        $theme->add_hook('footer_1', 'footer_1_default_widgets');
        $theme->add_hook('footer_2', 'footer_2_default_widgets');
        $theme->add_hook('footer_3', 'footer_3_default_widgets');
        $theme->add_hook('footer_4', 'footer_4_default_widgets');
        
        function footer_1_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Links');
        }
        
        function footer_2_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Recent_Posts', array('number' => '6'));
        }
        
        function footer_3_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Search');
            $theme->display_widget('Tag_Cloud');
            
        }
        
        function footer_4_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Text', array('title' => 'Contact', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nis.<br /><br /> <span style="font-weight: bold;">Our Company Inc.</span><br />2458 S . 124 St.Suite 47<br />Town City 21447<br />Phone: 124-457-1178<br />Fax: 565-478-1445'));
        }
    }

    
    
?>