<?php
namespace Modules\Common\Libraries;
use CodeIgniter\HTTP\Request;

class Maintenance_mode
{
    public $set = false;
    public $ip_address = array();
 
    function set($switch, $ip_address = array())
    {
        if(isset($switch) && is_bool($switch)):

            // let it the switch be readable by the check() function
            if ($switch == TRUE):
            
                $this->set = $switch;
                    
                // if ip is of the string type convert that beast to an array
                if (is_string($ip_address) && !empty($ip_address)):
                    $ip_address = array($ip_address);
                endif;
                
                // if it's an array and the array isn't empty
                if (is_array($ip_address) && count($ip_address) > 0):
                    
                    
                    if (isset($this->ip_address) && is_array($this->ip_address) && count($this->ip_address) > 0):
                    
                        // loop through array of ips
                        foreach ($ip_address as $ip) {
                            if(!in_array($ip, $this->ip_address))
                            $this->ip_address[] = $ip;
                        }
                        
                    else:
                    
                        $this->ip_address = $ip_address;
                        
                    endif;
                endif;
            
            // if $switch isn't TRUE, do nothing
            else:
                // nothing to do.... da di da di da
            endif;
            
            
        // $switch is either not been set or is not boolean
        else:
            show_error('You must set the first parameter of the Maintenance_mode::set() function. The value must also be boolean.');
        endif;
    }
    
    function check()
    {
        /**
         * --------------------------------
         * IF MAINTENANCE MODE HASN'T
         * BEEN TURNED ON, QUIETLY EXIT
         * --------------------------------
         */
        if (!isset($this->set))
        {
            return;
        }
        
        
        /**
         * --------------------------------
         * SET VARS FOR EASIER READABILITY
         * --------------------------------
         */
        $set         = $this->set;
        $ip_address = isset($this->ip_address) ? $this->ip_address : array();
        
        
        
        /**
         * ----------------------------
         * IF MAINTENANCE MODE IS ON
         * ----------------------------
         */
        if ($set == TRUE)
        {
            $request = new request;
            // Administrators and people that have been granted access via a "maintenance ip" can be shown the page
            // if ($this->global['is_administrator'] || in_array($request->getIPAddress(), $ip_address))
            if (in_array($request->getIPAddress(), $ip_address))
            {
                return;
            }
            echo view('App\Views\maintenance');
            die();
            // $message = "We're sorry for the inconvenience, this section of WEBSITE_NAME is undergoing necessary scheduled maintenance.";
            
            // show_error($message, 500, "Scheduled Maintenance");
        }
    }

    
}