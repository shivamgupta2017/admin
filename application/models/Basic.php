<?php  if (! defined('BASEPATH')) {
     exit('No Direct Script Access Allowed');
 }

/** 
* class basic model
* @category model (database)
*/

class basic extends CI_Model
{
   
    //=====================================================function parameter specifications begin===================================================

        // $table 	 =  name of the table (string)						Ex- 'user'
        // $select   =  select item (array)								Ex- array('id','name','email')			
        // $join 	 =  join condition (array)							Ex- array('role'=>"user.id=role.id,left",'vendor'=>"'user.id=vendor.id,left");
        // $data     =  data to be inserted,updated (array)				Ex- array('id'=>1,'name'=>'Al-amin','email'=>'jwel.cse@gmail.com')
        // $order_by =  order by (string)								Ex- 'id asc,name dsc'  // also array parameter accepted as $data[]
        // $group_by =  group by (string)								Ex- 'name'
        // $limit    =  upper limit (int)								Ex- 25
        // $start    =  lower limit (int)								Ex- 1
        // $id    	 =  id of a table (int)								Ex- 17

                //=========== where clause forming in details with examples begin==============

                /*
                // you can use >,>=,<,<= replacing != , if you need
                // you can use %match,match%,match replacing %match% , if you need
                // all array variables are named as they work (active record)

                
                // forms the where clause (active record)
                $where_simple =		array
                                     (
                                          'id'						=> 1,
                                        'username'					=> 'alamin',
                                        'reference_id != '			=> 0,
                                        'role_id LIKE '				=> '%909%',
                                        'role_id NOT LIKE '			=> '%997509%'
                                     );


                // forms the where_in clause (active record)
                $where_in =			array
                                     (
                                          'id'						=> array(123,1,3),
                                          'reference_id'				=> array(123,1,3)
                                     );

                // forms the where_not_in clause (active record)
                $where_not_in =		array
                                     (
                                          'id'						=> array(44,55),
                                          'reference_id'				=> array(77,88)
                                     );

                // forms the or_where clause (active record)
                $or_where =			array
                                     (
                                          'role_id'					=> 1,
                                          'reference_id'				=> 'alamin',
                                          'id != '					=> 8787,
                                        'password LIKE '			=> '%7076%',
                                        'password NOT LIKE '		=> '%765666%'
                                     );

                // forms the or_where clause (active record) but in a custom way
                // active record can not handle conditions such as : WHERE 'field' = 'match1' OR 'field' = 'match2' 
                // because it is passed by an array and there occours duplicate array index (field)
                // so here match value is used as array index and field name is used as corresponding value
                // it is not needed frequently but if you need you can use as shown below
                $or_where_advance =	array
                                     (
                                          '123'						=> 'password',
                                          '2424'						=> 'password',
                                           9							=> 'role_id'
                                     );

                // forms the or_where_in clause (active record)
                $or_where_in =		array
                                    (
                                        'user_type_id'				=> array(123,1,3),
                                        'user_individual_type_id'	=> array(123,1,3)
                                    );

                // forms the or_where_not_in clause (active record)
                $or_where_not_in =	array
                                    (
                                        'user_type_id'      	  	=> array(44,55),
                                        'user_individual_type_id' 	=> array(77,88)
                                    );
                
                // forms the final where clause array				
                $where =			array
                                    (
                                        'where'						=> $where_simple,
                                        'where_in'					=> $where_in,
                                        'where_not_in'				=> $where_not_in,
                                        'or_where'					=> $or_where,
                                        'or_where_advance'			=> $or_where_advance,
                                        'or_where_in'				=> $or_where_in,
                                        'or_where_not_in'			=> $or_where_not_in
                                    );
                */

                //=========== where clause forming in details with examples end==============

    //==================================================function parameter specifications end=========================================================

    /**
    * method to generate where clause
    * @access public
    * @return void 
    * @param $where array
    */

    public function generate_where_clause($where) //generates the joining clauses as given array
    {
        $keys = array_keys($where);  // holds the clause types. Ex- array(0=>'where',1=>'where_in'......................) 

        for ($i=0;$i<count($keys);$i++) {
            if ($keys[$i]=='where') {
                $this->db->where($where['where']);
            }  // genereates the where clauses

            elseif ($keys[$i]=='where_in') {
                $keys_inner = array_keys($where['where_in']); // holds the field names. Ex- array(0=>'id',1=>'username'......................) 
                for ($j=0;$j<count($keys_inner);$j++) {
                    $field=$keys_inner[$j]; // grabs the field names
                    $value=$where['where_in'][$keys_inner[$j]];     // grabs the array values of the grabed field to be find in
                    $this->db->where_in($field, $value);    //genereates the where_in clause	s				
                } //end for
            } //end else if

            elseif ($keys[$i]=='where_not_in') {
                // works similar as where_in specified above

                $keys_inner = array_keys($where['where_not_in']);
                for ($j=0;$j<count($keys_inner);$j++) {
                    $field=$keys_inner[$j];
                    $value=$where['where_not_in'][$keys_inner[$j]];
                    $this->db->where_not_in($field, $value);    // genereates the where_not_in clauses					
                } // end for
            } // end else if

            elseif ($keys[$i]=='or_where') {
                $this->db->or_where($where['or_where']);
            } // genereates the or_where clauses

            elseif ($keys[$i]=='or_where_advance') {
                // works similar as where_in but the array indexes & values are in reverse format as given parameter 

                $keys_inner = array_keys($where['or_where_advance']);
                for ($j=0;$j<count($keys_inner);$j++) {
                    $field=$where['or_where_advance'][$keys_inner[$j]];
                    $value=$keys_inner[$j];
                    $this->db->or_where($field, $value);    // genereates the or_where clauses								
                } // end for
            } // end else if

            elseif ($keys[$i]=='or_where_in') {
                // works similar as where_in specified above

                $keys_inner = array_keys($where['or_where_in']);
                for ($j=0;$j<count($keys_inner);$j++) {
                    $field=$keys_inner[$j];
                    $value=$where['or_where_in'][$keys_inner[$j]];
                    $this->db->or_where_in($field, $value);    // genereates the or_where_in clauses					
                } // end for
            } // end else if

            elseif ($keys[$i]=='or_where_not_in') {
                // works similar as where_in specified above

                $keys_inner = array_keys($where['or_where_not_in']);
                for ($j=0;$j<count($keys_inner);$j++) {
                    $field=$keys_inner[$j];
                    $value=$where['or_where_not_in'][$keys_inner[$j]];
                    $this->db->or_where_not_in($field, $value);    // genereates the or_where_not_in clauses					
                } // end for
            } // end else if			
        } // end outer for	
    }

    /**
    * method to generate joining clause
    * @access public
    * @return void
    * @param $join array
    */
    public function generate_joining_clause($join) //generates the joining clauses as given array
    {
        $keys = array_keys($join);
        for ($i=0;$i<count($join);$i++) {
            $join_table=$keys[$i]; //gets the array key (this is the joining table's name)
            $join_condition_type=explode(',', $join[$keys[$i]]); //explodes the array value (separated by a comma - 1st part:joing condition and second part:joining type)
            $join_condition=$join_condition_type[0];
            $join_type=$join_condition_type[1];

            $this->db->join($join_table, $join_condition, $join_type); //forms the join clauses
        }
    }
    /**
    * method to pull data from table
    * @access public
    * @return $result_array array
    * @param $table string
    * @param $where array
    * @param $select array
    * @param $join array
    * @param $limit integer
    * @param $start integer
    * @param $order_by array
    * @param $group_by both array and string
    * @param $num_row integer
    * @param $csv string
    */
    public function get_data($table, $where='', $select='', $join='', $limit='', $start=null, $order_by='', $group_by='', $num_rows=0, $csv='') //selects data from a table as well as counts number of affected rows
    {

        // only get data except deleted values
        // $col_name=$table.".deleted";
        // if($this->db->field_exists('deleted',$table) && $show_deleted==0)
        // $where['where'][$col_name]="0";
    


        $this->db->select($select);
        $this->db->from($table);
        
        if ($join!='') {
            $this->generate_joining_clause($join);
        }
        if ($where!='') {
            $this->generate_where_clause($where);
        }

        if ($this->db->field_exists('deleted', $table)) {
            $deleted_str=$table.".deleted";
            $this->db->where($deleted_str, "0");
        }
        
        if ($order_by!='') {
            $this->db->order_by($order_by);
        }
        if ($group_by!='') {
            $this->db->group_by($group_by);
        }       
        
        if (is_numeric($start) || is_numeric($limit)) {
            $this->db->limit($limit, $start);
        }
                    
        $query=$this->db->get();
        if ($csv==1) 
        {   
            
            return $query;
        } //csv generation requires resourse ID

        $result_array=$query->result(); //fetches the rows from database and forms an array[]
        if ($num_rows==1) {
            $num_rows=$query->num_rows(); //counts the affected number of rows
            $result_array['extra_index']=array('num_rows'=>$num_rows);    //addes the affected number of rows data in the array[]
        }
        
        // print_r($this->db->last_query());
        return $result_array; //returns both fetched result as well as affected number of rows		
    }



    /**
    * method to count row
    * @access public
    * @return $result_array array
    * @param $table string
    * @param $where array
    * @param $count string
    * @param $join array
    * @param $group_by both array and string
    */
    
    //to get sum of som couple of rows

    public function get_sum_of_sales($table, $where, $specific_column)
    {

        $result=$this->db->select_sum($specific_column)->where($where)->get($table)->result();
        return $result;
    }
    public function get_challan_products($purchase_id)
    {   
        $result=$this->db->select('b2b_purchase_details.product_id, b2b_purchase_details.quantity, b2b_purchase_details.cost, b2b_products.product_name, b2b_product_price.unit_name, b2b_product_price.weight')->from('b2b_purchase_details')->where('b2b_purchase_details.purchase_id',$purchase_id)->join('b2b_products', 'b2b_purchase_details.product_id = b2b_products.product_id')->join('b2b_product_price','b2b_purchase_details.product_id=b2b_product_price.product_id')->get()->result();
        //print_r(json_encode($result)); die;
        return $result;
    }
    public function get_sum_of_rows_in_customer_balance()
    {
        $user_id=$this->db->select('b2b_users.user_id, b2b_users.client_name')->from('b2b_users')->get()->result();
        //print_r(json_encode($user_id)); die;
        foreach ($user_id as $key => $value) 
        {   
            $user_data=($value->user_id);
            $test1= $this->db->select_sum('receivable_amount')->from('b2b_sales')->where('client_id', $user_data)->get()->result();
            $value->receivable_amount=$test1[0]->receivable_amount;
            $test2 = $this->db->select_sum('received')->from('b2b_receiving')->where('client_id', $user_data)->get()->result();
            $value->received=$test2[0]->received;

        }
        return $user_id;

    }
    public function get_sum_of_rows_in_vendor_details()
    {
        $vendors=$this->db->select('b2b_vendor.vendor_id,b2b_vendor.vendor_name')->from('b2b_vendor')->get()->result();
        foreach ($vendors as $key => $value) 
        {
            $vendor_id=$value->vendor_id;
            $test1=$this->db->select_sum('payable_amount')->from('b2b_purchase')->where('vendor_id', $vendor_id)->get()->result();
            $value->payable_amount=$test1[0]->payable_amount;
            $test2=$this->db->select_sum('paid_amount')->from('b2b_paid')->where('vendor_id', $vendor_id)->get()->result();
            $value->paid_amount=$test2[0]->paid_amount;
        }

        return $vendors;
    }
    public function get_two_table_data($id)
    {

        
        $result1=$this->db->select('b2b_sales.date as date, b2b_sales.client_id as client_id, b2b_sales.receivable_amount as receivable_amount, b2b_sales.received_amount as received')->from('b2b_sales')->where('b2b_sales.client_id',$id)->get_compiled_select();
        $result2=$this->db->select('b2b_receiving.date as date, b2b_receiving.client_id as client_id,   receivable_amount_f as receivable_amount, b2b_receiving.received as received')->from('b2b_receiving')->where('b2b_receiving.client_id', $id)->order_by('date','ASC')->get_compiled_select();

        $query = $this->db->query($result1." UNION ".$result2)->result();
        return $query;


    }
    public function count_row($table,$where='',$count='id',$join='',$group_by='') //counts data from a table
    {
        // $count_str="COUNT(".$count.") as total_rows";       
        $this->db->select($count);
        $this->db->from($table);

        if($join!='')                   $this->generate_joining_clause($join);      
        if($where!='')                  $this->generate_where_clause($where);

        if ($this->db->field_exists('deleted', $table)) {
            $deleted_str=$table.".deleted";
            $this->db->where($deleted_str, "0");
        }
        
        if($group_by!='')               $this->db->group_by($group_by);
                            
        $query=$this->db->get();    

        $num_rows = $query->num_rows();                
        $result_array[0]['total_rows']=$num_rows; 
        
        return $result_array; 
    }

    /**
    * method to insert data into table
    * @access public
    * @return true
    * @param $table string
    * @param $data array
    */
    public function insert_data($table, $data)  //inserts data into a table 
    {
        $this->db->insert($table, $data);
        return true;
    }
public function insert_data_id($table, $data)  //inserts data into a table 
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /**
    * method to update data into table
    * @access public
    * @return true
    * @param $table string
    * @param $where array
    * @param $data array
    */
    public function update_data($table, $where, $data) //updates data of a table 
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return true;
    }

    /**
    * method to delete data from table
    * @access public
    * @return true
    * @param $table string
    * @param $where array
    */
    public function delete_data($table, $where) //deletes data from a table 
    {
        $this->db->where($where);
        $this->db->delete($table);
        return true;
    }
   public function set_deleted($table, $where) //deletes data from a table 
    {
        $data = array('is_deleted'=>'1');
        $this->db->where($where);
        $this->db->update($table,$data);
        return true;
    }
    public function retrieve_deleted($table, $where) //deletes data from a table 
    {
        $data = array('is_deleted'=>'0');
        $this->db->where($where);
        $this->db->update($table,$data);
        return true;
    }
    
    public function set_update_cost_and_selling_price($table, $data) //deletes data from a table 
    {

        $update_data['selling_price']=$data['selling_price'];
        $update_data['purchase_price']  =$data['purchase_price'];
        $this->db->where('product_id',  $data['product_id'])->update($table, $update_data);
       // print_r($this->db->last_query()); die;
        return true;
    }


    /**
    * method to execute query
    * @access public
    * @return $query->result_array() array
    * @param $sql string	
    */
    public function execute_query($sql) //executes custom sql query
    {
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    /**
    * method to execute complex query
    * @access public
    * @return $query=$this->db->query($sql) string
    * @param $sql string	
    */
    public function execute_complex_query($sql) //executes complex custom sql query
    {
        return $query=$this->db->query($sql);
    }
    /**
    * method to check active or not
    * @access public
    * @return false
    * @param $table string	
    * @param $where array	
    */
    public function is_active($table, $where='') // checks a row's status of a table is active or not, returns true if active
    {
        $this->db->select('status');
        $this->db->from($table);
        $where['status']=1;
        $this->db->where($where);
        $query=$this->db->get();
        $num_rows=$query->num_rows();
        
        if ($num_rows>0) {
            return true;
        } else {
            return false;
        }
    }


    /**
    * method to check exist or not
    * @access public
    * @return false
    * @param $table string	
    * @param $where array	
    * @param $select array	
    */
    public function is_exist($table, $where='', $select='') //checks a row is exist or not, returns true if exists
    {
        $this->db->select($select);
        $this->db->from($table);
        if ($where!='') {
            $this->db->where($where);
        }
        $query=$this->db->get();
        $num_rows=$query->num_rows();
        if ($num_rows>0) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * method to check unique or not
    * @access public
    * @return false
    * @param $table string	
    * @param $where array	
    * @param $select array	
    */
    public function is_unique($table, $where='', $select='') //checks if a row is unique or not , returns true if unique
    {
        $this->db->select($select);
        $this->db->from($table);
        if ($where!='') {
            $this->db->where($where);
        }
        $query=$this->db->get();
        $num_rows=$query->num_rows();
        if ($num_rows>0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function multiple_join_get_data($sales_id, $user_id)
    {
        $this->db->select('b2b_sales.*');
        $this->db->select('b2b_sales_details.*');
        $this->db->select('b2b_products.product_name');
        $this->db->select('b2b_product_price.unit_name');
        $this->db->from('b2b_sales');
        $this->db->where('b2b_sales.sales_id', $sales_id);
        $this->db->join('b2b_sales_details', 'b2b_sales_details.sales_id = b2b_sales.sales_id');
        $this->db->join('b2b_products', 'b2b_sales_details.product_id = b2b_products.product_id');
        $this->db->join('b2b_product_price', 'b2b_product_price.product_id = b2b_products.product_id');
        $query = $this->db->get()->result();
        return $query;
    }
    public function join_for_purchase_data($purchase_id, $vendor_id)
    {
        $this->db->select('b2b_purchase.*, b2b_purchase_details.*, b2b_products.product_name, b2b_product_price.unit_name');
        $this->db->from('b2b_purchase');
        $this->db->where('b2b_purchase.purchase_id',$purchase_id);
        $this->db->join('b2b_purchase_details', 'b2b_purchase.purchase_id=b2b_purchase_details.purchase_id');
        $this->db->join('b2b_products','b2b_purchase_details.product_id=b2b_products.product_id');
        $this->db->join('b2b_product_price', 'b2b_product_price.product_id=b2b_products.product_id');
        $result=$this->db->get()->result();
        return $result;
    }

    public function is_unique_id($table, $where='', $select='',$select1='') //checks if a row is unique or not , returns true if unique
    {
        $this->db->select($select);
        $this->db->from($table);
        if ($where!='') {
            $this->db->where($where);
        }
        $query=$this->db->get();
        $data=$this->db->select($select1)->from($table)->where($where)->get()->row();
        $num_rows=$query->num_rows();
        if ($num_rows>0) {
            return $data;
        } else {
            return 0;
        }
    }
    /**
    * method to get enum valus from a field
    * @access public
    * @return $enumList; array
    * @param $table_name string	
    * @param $column_name string
    */
    public function get_enum_values($table_name="", $column_name="") //return array of enum values of a field in a table
    {
        $empty_array=array();
        
        if ($table_name=="" || $column_name=="") {
            return $empty_array();
        }

        $sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'";
        $results=$this->execute_query($sql);
        
        $enumList = explode(",", str_replace("'", "", substr($results[0]['COLUMN_TYPE'], 5, (strlen($results[0]['COLUMN_TYPE'])-6))));
        return $enumList;
    }

    /**
    * method to DUMP DATA
    * @access public
    * @return boolean
    * @param string	
    */
    public function get_post_data(){
        return $this->input->post();
    }
    public function get_file_content(){
        return json_decode(file_get_contents("php://input"),true);
    }
    public function get_get_data(){
        return $this->input->get();
    }
    public function get_profit_loss($date1, $date2)
    {
        
        //sales products between dates

        $data['sales_products'] = $this->db->select('date')->from('b2b_inventory')->where('date>=', $date1)->where('date<=',$date2)->where('type','out')->where('purchase_status!=','pending')->get()->result();
        $data['total_sales'] =$this->db->select_sum('total_sales')->from('b2b_inventory')->where('date>=',$date1)->where('date<=',$date2)->where('type','out')->where('purchase_status!=','pending')->get()->result();
        
        
        $data['total_purchase']=$this->db->select_sum('payable_amount')->from('b2b_purchase')->where('date>=',$data['sales_products'][0]->date)->where('date<=',$data['sales_products'][sizeof($data['sales_products'])-1]->date)->get()->result();        
        
        $new_data['total_purchase']=$data['total_purchase'][0]->payable_amount;
        $new_data['total_sales']=$data['total_sales'][0]->total_sales;
        return $new_data;        
    }
    public function import_dump($filename = '')
    {
        if ($filename=='') {
            return false;
        }
        if (!file_exists($filename)) {
            return false;
        }
        
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);

        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $this->execute_complex_query($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
        return true;
    }
    public function generate_invoice($id){
     $select = array('order_products.*','orders.user_id','orders.is_express','product_details.*','product_details.total_tax as rate');
     $where['where'] = array('order_products.order_id'=>$id,'order_products.is_verified'=>2);
     $join = array(
            'orders'=>'order_products.order_id = orders.id,inner',
            'product_details'=>'product_details.product_id = order_products.product_id,inner');
     $data['products'] = $this->basic->get_data('order_products',$where,$select,$join);
     $where['where'] = array('{PRE}users.user_id'=>$data['products'][0]->user_id,'orders.id'=>$id);
     $join = array('{PRE}orders'=>'{PRE}users.user_id = {PRE}orders.user_id,inner','{PRE}shipping_addresses'=>'{PRE}orders.selected_address_id = {PRE}shipping_addresses.shipping_add_id,inner');
     $data['shipping_details'] = $this->basic->get_data('{PRE}users',$where,'{PRE}users.*,{PRE}shipping_addresses.*',$join);
     if($data['products'][0]->is_express){
     $data['express_charges'] = $this->basic->get_data('{PRE}city',array('where'=>array('{PRE}city.postal_code'=>$data['shipping_details'][0]->shipping_zip)),'{PRE}city.express_shipping_charges');
    }
    else{
        $data['express_charges'] = 0;
    }
     $invoice_id = $this->basic->insert_data_id('{PRE}invoice',array('user_id'=>$id,'first_name'=>$data['shipping_details'][0]->first_name,'last_name'=>$data['shipping_details'][0]->last_name,'email'=>$data['shipping_details'][0]->email));
     $data['invoice_id'] = $invoice_id;
     foreach($data['products'] as $index=>$temp){
      $data['products'][$index] = json_decode(json_encode($data['products'][$index]),true);}
       $data['invoice_date'] = date('d/m/Y');
        $data['create_date'] = date('Y-m-d');
         $data['due_date'] = date('d/m/Y',strtotime(date('d-m-Y')));
          $this->load->view('Pdf/pdf',$data);
           return $data['invoice_id'];
    }
    public function generate_challan($id,$time_stamp =''){
     $select = array('order_products.*','orders.user_id','orders.is_express','product_details.*','product_details.total_tax as rate');
     $where['where'] = array('order_products.order_id'=>$id,'order_products.is_verified'=>0);
     $join = array(
            'orders'=>'order_products.order_id = orders.id,inner',
            'product_details'=>'product_details.product_id = order_products.product_id,inner');
     $data['products'] = $this->basic->get_data('order_products',$where,$select,$join);
     $where['where'] = array('{PRE}users.user_id'=>$data['products'][0]->user_id,'orders.id'=>$id);
     $join = array('{PRE}orders'=>'{PRE}users.user_id = {PRE}orders.user_id,inner','{PRE}shipping_addresses'=>'{PRE}orders.selected_address_id = {PRE}shipping_addresses.shipping_add_id,inner');
     $data['shipping_details'] = $this->basic->get_data('{PRE}users',$where,'{PRE}users.*,{PRE}shipping_addresses.*',$join);
     if($data['products'][0]->is_express){
     $data['express_charges'] = $this->basic->get_data('{PRE}city',array('where'=>array('{PRE}city.postal_code'=>$data['shipping_details'][0]->shipping_zip)),'{PRE}city.express_shipping_charges');
    }
    else{
        $data['express_charges'] = 0;
    }
     foreach($data['products'] as $index=>$temp){
     $data['products'][$index] = json_decode(json_encode($data['products'][$index]),true);}
        $data['invoice_date'] = date('d/m/Y');
        $data['create_date'] = date('Y-m-d');
        $data['due_date'] = date('d/m/Y',strtotime(date('d-m-Y')));
        $data['time_stamp'] = $time_stamp;
        $this->load->view('Pdf/challan',$data);
                  return 1;
    }
    public function get_editable_products($purchase_id)
    {
        $data=$this->db->select('b2b_purchase_details.*, b2b_products.product_name, b2b_product_price.unit_name')->from('b2b_purchase_details')->where('purchase_id',$purchase_id)->join('b2b_products', 'b2b_purchase_details.product_id=b2b_products.product_id')->join('b2b_product_price', 'b2b_purchase_details.product_id=b2b_product_price.product_id')->get()->result();

        return $data;


    }
    public function delete_rows_edit_purchase($purchase_id)
    {

          $this->db->where('purchase_id',$purchase_id)->delete('b2b_purchase_details');
          return true;
    }
    public function update_purchase_data($purchase_id)
    {
        $this->db->set('purchase_status','order')->where('purchase_id', $purchase_id)->update('b2b_purchase');
        return true;
    }

}