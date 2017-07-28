# php-table-class
I wanted a class that would allow me to create a HTML table with any number of buttons with different functions


$users_allowable = array('User ID','Name','Role','Date Registered','Inactive');
$sql = 'SELECT `usr_id`,`usr_id` AS `User ID`, `usr_name` AS `Name`, `usr_role` AS Role, `usr_dateadded` AS `Date Registered`, `usr_inactive` AS Inactive  FROM tbl_user ORDER BY usr_name';
$params = array();


$mylist = new html_table();
$mylist->_btn_names = array('Edit','Test');
$mylist->_btn_type = array('Edit' => 'link','Test' => 'button');
$mylist->_btn_classes = array('Edit' => array('btn ','btn-primary ','btn-xs'),
                              'Test' => array('btn btn-danger btn-xs'));
$mylist->_btn_action = array('Edit' => 'none',
                             'Test' => 'onclick');
$mylist->_btn_event = array('Edit' => 'none',
                            'Test' => 'bs_openInModal');
$mylist->_btn_url = array('Edit' => 'user_profile.php',
                            'Test' => 'forms/bs_edit_user');
$mylist->_btn_params = array('Edit' => array('usr_id'),
                             'Test'=> array('usr_id','Name'));
$list = $mylist->buildTable($sql,$params,$users_allowable);
echo $list;
