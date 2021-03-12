<?php
namespace Modules\Common\Libraries;

class Sidebar {
	protected $_items = NULL;
	
	private $_data = array();
	private $_user_type;
	private $_item_idx = 0;
	private $_sub_idx = 0;
	private $_username = '';

	private $_sub_arrow_open = '';
	private $_sub_arrow_clos = '';
	
	private $_has_page_header = FALSE;
	private $_show_breadcrumbs;
	private $_show_page_title;

	private $_active_cls = 'class="active"';
	private $_selected = '';
	
	private $_page_title = '';
	
	private $error_msg = array();
	
	function __construct(array $params = array()) {
		if (!empty($params['show_page_title'])) {
			$this->_show_page_title = $params['show_page_title'];
			unset($params['show_page_title']);
		}
		
		if ( ! empty($params['show_breadcrumbs'])) {
			$this->_show_breadcrumbs = $params['show_breadcrumbs'];
			unset($params['show_breadcrumbs']);
		}
		
		if ( ! empty($params['item_index']) ){
			$this->_item_idx = $params['item_index'];
			unset($params['item_index']);
		}
		
		if ( ! empty($params['sub_index']) ){
			$this->_sub_idx = $params['sub_index'];
			unset($params['sub_index']);
		}
		
		if ( ! empty($params['page_title']) ) {
			$this->_page_title = $params['page_title'];
			unset($params['page_title']);
		}

		if ( ! empty($params['user_type']) ) {
			$this->_user_type = $params['user_type'];
			unset($params['user_type']);
		}

		if ( ! empty($params['username']) ) {
			$this->_username = $params['username'];
			unset($params['user_type']);
		}
		

		$this->_items = $this->_sidebar_items();
	}

	function process_page_properties()
	{
		$this->error_msg[] = $this->_item_idx;
		$this->create_sidebar();
		$this->create_page_title();
		$this->create_breadcrumb();

		if ($this->_has_page_header) 
			$this->_data['has_page_header'] = TRUE;
		else 
			$this->_data['has_page_header'] = FALSE;
	}
	
	function get_page_properties()
	{
		return $this->_data;
	}
	
	/**
	* Sets the item index variable to the current active index
	* @param string $item_index
	* 
	* @return
	*/
	function set_active_menuitem($item_index = 0, $sub_index = 0)
	{
		$this->_item_idx = $item_index;
		$this->_sub_idx = $sub_index;
	}
	
	/**
	* Create a sidebar for the page
	* 
	* @return
	*/	
	function create_sidebar()
	{
		$li = array();
		$sub_len = 0;
		$sub;
        $len = count($this->_items);
        
		//<li><a href="index.html"><i class="icon-home"></i> Dashboard</a></li>
		for($i=1; $i<=$len; $i++)
		{
			
			if (in_array($this->_user_type, $this->_items[$i]['permissions'])) {

				$active = '';
				$label = '';

				$active .= '';
				$is_active = FALSE;
				$label .= $this->_items[$i]['icon'];

				//check if first item
				// if ($i == 1) $active .= '';

				//check if item is active
				if ($i == $this->_item_idx) {
					$is_active = TRUE;
					$label .= $this->_selected;
					$active .= ' active';

					if (count($this->_items[$i]['sub']) > 0) $active .= ' class=""';
				}

				//check if item has sub menu
				$sub_count = count($this->_items[$i]['sub']);
				if ($sub_count > 0) {
					
					//<a href="#"><i class="icon-briefcase"></i> UI Elements <span class="label">6</span></a>
					$sub = $this->create_submenu($i, $this->_items[$i]['sub']);
					$label .= " <span class=\"title\">".$this->_items[$i]['name']."</span>";
					$label .="<span class=\"arrow ". ( isset($sub[1]) && $sub[1] == $i? 'open':'' ) ."\"></span>";
					//$anchr = anchor($this->_username . '/'. $this->_items[$i]['url'], $label, '');
					$anchr = '<a href="javascript:;">' . $label.'</a>';

					
					
					$li[] = '<li class="'. ( isset($sub[1]) && $sub[1] == $i? 'active open':'' ) .'">'.$anchr.$sub[0].'</li>';
					
				}
				else {
					$anchr = anchor($this->_username . '/'. $this->_items[$i]['url'], $label."<span class=\"title\">".$this->_items[$i]['name']."</span>", '');
					$li[] = '<li class="'.$active.'">'.$anchr.'</li>';
				}

			}
        }
        // echo var_dump($li);
		$this->_data['sidebar'] = $li;
	}
	
	function create_anchor($url, $lbl)
	{
		//return '<a href="'.$url.'">'.$lbl.'</a>';
	}
	
	function create_submenu($idx, $sub)
	{
        $subm[0] = '';
        $subLi = '';
        $is_active = FALSE;
		for ($j=1; $j<=count($sub); $j++)
		{
			if (in_array($this->_user_type, $sub[$j][4])) {
				$active = '';
				
				if (($this->_item_idx == $idx) AND (($this->_sub_idx == $j))) { 

					if  ($this->_sub_idx == $j) {
                        $active .= ' active';
						$subm[1] = $idx;
						$is_active = TRUE;
					}
                }

				$label = anchor($this->_username . '/'. $sub[$j][1], '<span class="title">'.$sub[$j][0].'</span>', 'class="nav-link"');
				$subLi .= '<li class="'.$active.'">'.$label.'</li>';
			}
        }
        if( $is_active ) $mainUl = '<ul class="sub-menu" style="display: block;">';
        else $mainUl = '<ul class="sub-menu" style="display: none;">';
        $subLi .= '</ul>';
        $subm[0] .= $mainUl;
        $subm[0] .= $subLi;
		return $subm;
	}
	
	/**
	* Retrieves an entry from dugout to be insert into atbat
	* 
	* @return
	*/
	function create_page_title()
	{
		$page_title = '';

		if ($this->_show_page_title == 1) {
			if ($this->_page_title != '') {
					$page_title .= $this->_items[$this->_item_idx]['title'];
			} else {
				if ($this->_sub_idx == 0) {
					$page_title .= $this->_items[$this->_item_idx]['title'].$this->_items[$this->_item_idx]['title_desc'];
				} else {
					$page_title .= $this->_items[$this->_item_idx]['sub'][$this->_sub_idx][0];
	                $page_title .= '	<small>'.$this->_items[$this->_item_idx]['sub'][$this->_sub_idx][2].'</small>';
				}
			
			}
				$this->_has_page_header = TRUE;
		}
		$this->_data['page-title'] = $page_title;
	}

	/**
	* Retrieves an entry from dugout to be insert into atbat
	* 
	* @return
	*/
	function create_breadcrumb()
	{
		$bread = '';
		if ($this->_show_breadcrumbs == 1) {
			$bread .= '<ul class="page-breadcrumb">';

			$bread .= '<li>'.
						anchor('member/home/', 'Home').'
					 </li>';
					 
			$bread .= '<li><i class="fa fa-circle"></i>'.anchor($this->_items[$this->_item_idx]['url'], $this->_items[$this->_item_idx]['name']);
			
			if ($this->_sub_idx > 0) {
				$bread .= '</li><li><i class="fa fa-circle"></i>'
							.anchor($this->_items[$this->_item_idx]['sub'][$this->_sub_idx][1], $this->_items[$this->_item_idx]['sub'][$this->_sub_idx][0]);
				
			}
			$bread .= '</ul>';
			$this->_has_page_header = TRUE;
		}
		
		$this->_data['breadcrumb'] = $bread;
	}
	
	function get_error()
	{
		return $this->error_msg;
	}

	protected function _sidebar_items()
	{
		return array(
			1 => array( 
						'title'			=> 'Dashboard',
						'title_desc'	=> ' <small>Dashboard</small>',
						'name'			=> 'Dashboard',
						'url' 			=> 'Dashboard',
						'icon' 			=> '<i class="fa fa-home"></i> ',
						'permissions'	=> array(ADMIN_ACCOUNT),
						'sub'			=> array()
			),
			2 => array(
						'title'			=> 'Package Library',
						'title_desc'	=> ' <small>Package Library</small>',
						'name'			=> 'Package Library',
						'url' 			=> 'Package_Library',
						'icon' 			=> '<i class="fa fa-dropbox"></i> ',
						'permissions'	=> array(ADMIN_ACCOUNT),
						'sub'			=> array()
			),
			3 => array(
						'title'			=> 'Product Library',
						'title_desc'	=> ' <small>Product Library</small>',
						'name'			=> 'Product Library',
						'url' 			=> 'Product_Library',
						'icon' 			=> '<i class="fa fa-cubes"></i> ',
						'permissions'	=> array(ADMIN_ACCOUNT),
						'sub'			=> array()
			),
			4 => array(
						'title'			=> 'Codes',
						'title_desc'	=> ' <small>Codes</small>',
						'name'			=> 'Codes',
						'url' 			=> '#',
						'icon' 			=> '<i class="fa fa-key"></i> ',
						'permissions'	=> array(ADMIN_ACCOUNT),
						'sub'			=> array(
											1 => array( '<i class="fa-spin icon-settings"></i> Activation Codes', 'Activation_Codes', '' ,4 => array(ADMIN_ACCOUNT)),
											2 => array( '<i class="icon-speech"></i> Product Codes', 'Product_Codes', '' ,4 => array(ADMIN_ACCOUNT)),
											3 => array( '<i class="icon-book-open"></i> SURVEY FORM', 'library/Survey_form', '' ,4 => array(ADMIN_ACCOUNT)),
						)
			),
			5 => array(
						'title'			=> 'Activation Codes',
						'title_desc'	=> ' <small>Activation Codes</small>',
						'name'			=> 'Activation Codes',
						'url' 			=> 'Activation_Codes',
						'icon' 			=> '<i class="fa fa-key"></i> ',
						'permissions'	=> array(DEVELOPER_ACCOUNT),
						'sub'			=> array()
			)
			
		);
	}
}
?>