<?php 

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class My_Example_List_Table extends WP_List_Table {
  
    private $example_data;
    private $found_data;
    function __construct(){
    global $status, $page;
    global $wpdb;
        parent::__construct( array(
            'singular'  => __( 'book', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'books', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
    ) );

    add_action( 'admin_head', array( &$this, 'admin_header' ) );            
    $data = array();
    $orderby = "";
    if(isset($_GET['orderby'])){
      $orderby = "order by ".$_GET['orderby']." desc";  
    }
    $search= "";
    if(isset($_POST['s'])){
      $search = "where name like '%".$_POST['s']."%' OR email like '%".$_POST['s']."%'";
    }
    $result = $wpdb->get_results("select * from wp_pdf_download $search $orderby");
    
    foreach ($result as $res) {
      $title = get_the_title($res->post_id);
      $category = get_the_category($res->post_id);
      $cateName = "";
      if(!empty($category)){ foreach($category as $cat){$cateName = $cat->name;}}
      $data[] = array("ID"=>$res->id,"name"=>$res->name,"email"=>$res->email,"title"=>$title,"category"=>$cateName,"datetime"=>$res->datetime);
    }
    if(isset($_GET['action']) && $_GET['action'] == "delete"){
       $wpdb->query("DELETE from wp_pdf_download where id =".$_GET['id']);
       wp_redirect( admin_url( '/?page=pdf_download_list' ) );
        exit;
    }
    $this->example_data = $data;
    
    }

  function admin_header() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'my_list_test' != $page )
    return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-name { width: 40%; }';
    echo '.wp-list-table .column-email { width: 35%; }';
    echo '.wp-list-table .column-datetime { width: 20%;}';
    echo '</style>';
  }

  function no_items() {
    _e( 'No data found, dude.' );
  }

  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'name':
        case 'email':
        case 'title':
        case 'category':
        case 'datetime':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_sortable_columns() {
  $sortable_columns = array(
    'name'  => array('name',false),
    'email' => array('email',false),
    'datetime'   => array('datetime',false)
  );
  return $sortable_columns;
}

function get_columns(){
        $columns = array(
            /*'cb'        => '<input type="checkbox" />',*/
            'name' => __( 'Name', 'mylisttable' ),
            'email'    => __( 'email', 'mylisttable' ),
            'title'    => __( 'Title', 'mylisttable' ),
            'category'    => __( 'Category', 'mylisttable' ),
            'datetime'      => __( 'datetime', 'mylisttable' )
        );
         return $columns;
    }

function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'name';
  // If no order, default to asc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}

function column_name($item){
  $actions = array(
            'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );

  return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions) );
}

/*function get_bulk_actions() {
  $actions = array(
    'delete'    => 'Delete'
  );
  return $actions;
}
*/
function column_cb($item) {
        /*return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );  */  
    }

function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  usort( $this->example_data, array( &$this, 'usort_reorder' ) );
  
  $per_page = 10;
  $current_page = $this->get_pagenum();
  $total_items = count( $this->example_data );
  
  // only ncessary because we have sample data
  $this->found_data = array_slice( $this->example_data,( ( $current_page-1 )* $per_page ), $per_page );

  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
  ) );
  $this->items = $this->found_data;
}

} //class



function my_add_menu_items(){
  $hook = add_menu_page( 'PDF Download List', 'PDF Download List', 'activate_plugins', 'pdf_download_list', 'my_render_list_page' );
  add_action( "load-$hook", 'add_options' );
}

function add_options() {
  global $myListTable;
  $option = 'per_page';
  $args = array(
         'label' => 'Books',
         'default' => 10,
         'option' => 'books_per_page'
         );
  add_screen_option( $option, $args );
  $myListTable = new My_Example_List_Table();
}
add_action( 'admin_menu', 'my_add_menu_items' );



function my_render_list_page(){
  global $myListTable;
  echo '</pre><div class="wrap"><h2>PDF Download List</h2>'; 
  $myListTable->prepare_items(); 
?>
  <form method="post">
    <input type="hidden" name="page" value="ttest_list_table">
    <?php
    $myListTable->search_box( 'search', 'search_id' );

  $myListTable->display(); 
  echo '</form></div>'; 
}