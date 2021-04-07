<?php

/*
* User Class is the base class will make curl request and 
* will fetch data to be send to view
*/

class Users
{

    // API URL
    const API_URL = "https://jsonplaceholder.typicode.com/users";

    // all users data
    protected $all_users;

    protected $users;

    /**
     * This method will return call users data
     * @return array|string
     */
    public function allUsers()
    {

        // curl request to all the api
        $this->all_users = self::curlRequest();

        // making sure there is data
        if(!empty($this->all_users )) {

            // loop through each data
            foreach ($this->all_users as $key => $value) {
                
                // set data
                $this->setData($value, $key);

            }
            
        }

        // return users
        return $this->users ?? "No data Found.";

    }

    /**
     * This method will return single user data
     * @return array
     */
    public  function getUser($id=null) 
    {

        // curl request to call the api
        $this->all_users = self::curlRequest();

        if(!empty($this->all_users))
        {

            foreach ($this->all_users as $key => $value) {
                
                if($value->id == $id) {
                    
                    // set user data
                    $this->setData($value, $key);
                    
                    return $this->users;

                    break;
                }
            }
        }

    }

    /**
     * This method will export user data in CSV format
     * @return file
     */
    public function exportCSV()
    {
        // get all data
        $this->all_users = self::curlRequest();

        if(!empty($this->all_users))
        {

            $delimiter = ",";

            $filename = "users_" . date('Y-m-d-h-i-s') . ".csv";
                
             //create a file pointer
            $f = fopen('php://memory', 'w');
             
            //set column headers
            $fields = array('Name', 'Email', 'Phone', 'City');

            fputcsv($f, $fields, $delimiter);
     
            //output each row of the data, format line as csv and write to file pointer
            foreach ($this->all_users as $key => $value) {

                // set user data
                $this->setData($value, $key);

                $line_data =  (array)$this->users[$key];

                fputcsv($f, $line_data, $delimiter);

            }

            //move back to beginning of file
            fseek($f, 0);
            
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            
            //output all remaining data on a file pointer
            fpassthru($f);

        }

    }

      /*
    * This method sets the data that can be used by getUser and
    * allUsers and exportCSV Method any alteration in DATA should be made in this method
    * @param array $value
    * @param int key
    * @return void
    */
    private function setData($value, $key) :void
    {

        $this->users[$key] = new StdClass;

        $this->users[$key]->name = ucwords($value->name);

        $this->users[$key]->email  = self::setEmail($value->email);

        $this->users[$key]->phone = self::setNumber($value->phone);

        $this->users[$key]->address = self::setAddress($value->address); 

    }

    /*
    * This method will set the email and will convert it in lowercase if valid 
    * else will return null
    * @param string Email
    */
    protected static function setEmail($email=null)
    {

        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? null : strtolower($email);
    
    }

    /*
    * This method will set the number and will 
    * else will return 0
    * @param int|string  
    * @return int phone
    */
    protected static function setNumber($phone=null) :int
    {
        return  (int) substr(preg_replace('/[^0-9]/', '', $phone), 0, 10);
    
    }

    /*
    * This method will set the Address 
    * @param string  
    * @return string address
    */
    protected static function setAddress($address) :string
    {
        $final_address = '';

        //$final_address .= $address->street ? ucwords($address->street).', ': '' ;

        //$final_address .= $address->suite ? ucwords($address->suite).', ': '' ;
        
        $final_address .= $address->city ? ucwords($address->city): '';

        //$final_address .= $address->zipcode ? ucwords($address->zipcode): '';

        return $final_address; 
    }

    /**
    * Make Curl request for the API 
    * @return array  response
    */
    private static function curlRequest()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(

            CURLOPT_URL => SELF::API_URL,
              
            CURLOPT_RETURNTRANSFER => true,
              
            CURLOPT_ENCODING => '',
              
            CURLOPT_MAXREDIRS => 10,
              
            CURLOPT_TIMEOUT => 5,
              
            CURLOPT_FOLLOWLOCATION => true,
              
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              
            CURLOPT_CUSTOMREQUEST => 'GET',

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        // return the API response
        return json_decode($response);

    }

}
