<?php

// This will be a list of fields you want to output from the returned results.
// This allows me to include for example the record ID but supress it from being output visably
$users_allowable = array('User ID','Name','Role','Date Registered','Inactive');
$sql = 'SELECT `usr_id`,`usr_id` AS `User ID`, `usr_name` AS `Name`, `usr_role` AS Role, `usr_dateadded` AS `Date Registered`, `usr_inactive` AS Inactive  FROM tbl_user ORDER BY usr_name';
$params = array();

//instantiate class
$mylist = new html_table();

// Here is how I have constructed the buttons

$mylist->_btn_names = array('Edit','Test'); // Button name and label
$mylist->_btn_type = array('Edit' => 'link','Test' => 'button'); // a button can either be a button or hyperlink dressed up as a button
$mylist->_btn_classes = array('Edit' => array('btn ','btn-primary ','btn-xs'),
                              'Test' => array('btn btn-danger btn-xs')); // Any classes that need to applied to each button
$mylist->_btn_action = array('Edit' => 'none', 
                             'Test' => 'onclick'); // the action that will trigger an event (js script to run)
$mylist->_btn_event = array('Edit' => 'none',
                            'Test' => 'bs_openInModal'); // What js function to call
$mylist->_btn_url = array('Edit' => 'user_profile.php',
                            'Test' => 'forms/bs_edit_user'); // url either for link or for ajax call
$mylist->_btn_params = array('Edit' => array('usr_id'),
                             'Test'=> array('usr_id','Name'));  //if a link this will hold the paramaters to pass along the http request.
                                                                // Where this is a js function it will place them into a json string
                                                                // Note these values match the field names in the SQL string
$list = $mylist->buildTable($sql,$params,$users_allowable); // Now build table

//output table
echo $list;

?>

