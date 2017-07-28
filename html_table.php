<?php
class html_table {
    public $_btn_names = array(),
            $_btn_classes = array(),
            $_btn_action = array(),
            $_btn_event = array(),
            $_btn_form = '',
            $_btn_type = array(),
            $_btn_url = array(),
            $_btn_params = array(),
            $_btn_modal = false;
    
    Public function buildTable($sql,$params,$allowable,$buttons = array()) {
        
        $html_table = '';
        $db = new DB();
        $users_list = $db->query($sql,$params)->results();

        $html_table = $html_table.'<table class="table">
          <thead>
            <tr>';
        foreach($users_list[0] as $key => $value){
            if(in_array($key,$allowable)) {
                $html_table = $html_table.'<th>'.$key.'</th>';
            }    
        }
        // buttons cell.... this needs to only be included where there are buttons
        if(count($this->_btn_names) != 0){
            $html_table = $html_table.'<th></th>';
        }
        // End of table header
        $html_table = $html_table.'</tr></thead>';
        // Table body started
        $html_table = $html_table.'<tbody>';
        foreach($users_list as $ul){
        $html_table = $html_table.'<tr>';
            foreach ($ul as $key => $value) {
                if(in_array($key,$allowable)) {
                    $html_table = $html_table.'<td>'.$value.'</td>';
                }    
            }

            if(count($this->_btn_names) != 0){
                $html_table = $html_table.'<td>';
                $x=0;
                foreach($this->_btn_names as $name){
                    $json = array();
                    $classes = '';
                    foreach($this->_btn_classes[$name] as $class){
                        $classes = $classes.$class;
                    }

                    if($this->_btn_type[$name] == 'link'){
                        $url = $this->_btn_url[$name];
                        $button = '<a href="'.$this->_btn_url[$name];
                        if(count($this->_btn_params[$name])){
                            $button = $button.'?';
                            foreach($this->_btn_params[$name] as $param){
                                $button = $button.$param.'='.$ul->$param.'&';
                            }

                        }
                        $button = rtrim($button,'&').'" ';

                    } else {

                        $button = '<button ';
                        foreach($this->_btn_params[$name] as $param){
                            $json[$param] = $ul->$param;
                        }
                        $json_string = json_encode($json);
                    }
                    $button = $button.' class="'.$classes.'" ';

                    if($this->_btn_action[$name] != 'none'){
                        $url = $this->_btn_url[$name];

                        $button = $button.$this->_btn_action[$name].'="'.$this->_btn_event[$name].'("'.$url.'",'.$json_string.',1)"';
                    }                
                    if($this->_btn_type[$name] == 'link'){
                        $button = $button.'>'.$name.'</a>';
                    } else {
                        $button = $button.'>'.$name.'</button>';    
                    }
                    // add button to table
                    $html_table = $html_table.$button;
                    $x++;

                }
                $html_table = $html_table.'</td>';
            }
            $html_table = $html_table.'</tr>';
          }
          $html_table = $html_table.'</tbody>';
        $html_table = $html_table.'</table>';
        return $html_table;
    }
}