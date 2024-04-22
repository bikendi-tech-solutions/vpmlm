<?php
/**
*Plugin Name: VP MLM
*Plugin URI: https://vtupress.com
*Description: Add Multi-Level-Marketing To Vtupress
*Version: 2.3.2
*Author: Akor Victor
*Author URI: https://facebook.com/akor.victor.39
*/

if(!defined('ABSPATH')){
    $pagePath = explode('/wp-content/', dirname(__FILE__));
    include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));
};
if(WP_DEBUG == false){
error_reporting(0);	
}
include_once(ABSPATH.'wp-admin/includes/plugin.php');
$path = WP_PLUGIN_DIR.'/vtupress/functions.php';
if(file_exists($path) && in_array('vtupress/vtupress.php', apply_filters('active_plugins', get_option('active_plugins')))){
include_once(ABSPATH.'wp-content/plugins/vtupress/functions.php');
}
else{
	if(!function_exists("vp_updateuser")){
function vp_updateuser(){
	
}

function vp_getuser(){
	
}

function vp_adduser(){
	
}

function vp_updateoption(){
	
}

function vp_getoption(){
	
}

function vp_option_array(){
	
}

function vp_user_array(){
	
}

function vp_deleteuser(){
	
}

function vp_addoption(){
	
}

	}

}



require __DIR__.'/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/bikendi-tech-solutions/vpmlm/',
	__FILE__,
	'vpmlm'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

$myUpdateChecker->setAuthentication('your-token-here');

$myUpdateChecker->getVcsApi()->enableReleaseAssets();



if(vp_getoption('siteurl') != "https://vtupress.com" || vp_getoption('siteurl') != "vtupress.com" ){


vp_addoption("vp_min_withdrawal",0);
vp_addoption("vp_whatsapp",0);
vp_addoption("vp_phone_line",0);
vp_addoption("vp_first_level_bonus", 0);
vp_addoption("vp_second_level_bonus", 0);
vp_addoption("vp_first_trans_bonus", 0);
vp_addoption("vp_second_trans_bonus", 0);
vp_addoption("vp_third_trans_bonus", 0);
vp_addoption("vp_trans_min", 0);
vp_addoption("vp_third_level_bonus", 0);
vp_addoption("show_services_bonus", "yes");



function mlm_set(){
	
	if(vp_getoption('mlm') == "yes"){
	echo'
    <style>
    table.table th{
        font-size:0.9em;
        font-style:bold;
        }
        

            .dtable{
                max-width:100%;
                overflow:auto;
              }
        
    </style>

<div class="container dtable mlm_system">

    <div class="mlm-refer">
    <table class="table table-striped table-hover table-bordered table-responsive">
             <thead>
                 <tr>
                     <th scope="col">Name</th>
                     <th scope="col">value</th>
                 </tr>
                 
               </thead>
           <tbody>
				<tr>
                   <td>Discount Method: [Direct means discounted amount will be deducted on transaction and Charge Back Means discounted amount will drop as charge back bonus</td>
                   <td>
                   <div class="input-group mb-2">
                   <select name="discountmethod">
				   <option value="'.vp_getoption("discount_method").'">'.vp_getoption("discount_method").'</option>
				   <option value="direct">Direct</option>
				   <option value="charge">Charge Back</option>
				   </select>
                   </div>
                   </td>
               </tr>

           </tbody>
        </table>
    </div>
<br>

<div class="mlm-refer">
<table class="table table-striped table-hover table-bordered table-responsive">
         <thead>
             <tr>
                 <th scope="col">PV Rules:</th>
            
            </tr>
           </thead>
       <tbody class="pv_rules">    
           ';
           global $wpdb;
           $table_name = $wpdb->prefix."vp_pv_rules";
        $rules = $wpdb->get_results("SELECT * FROM  $table_name");

        global $wpdb;
        $table_name = $wpdb->prefix."vp_levels";
        $data = $wpdb->get_results("SELECT * FROM  $table_name");

        foreach($rules as $rule){

            echo'
            <tr>
           <td>
           RULE ('.$rule->id.'): <br>
           "<p>Upgrade User To
           ';


           ?>
           <select class="form-control level_id" name="set_plan<?php echo $rule->id;?>">
<option value="<?php echo $rule->upgrade_plan;?>"><?php echo strtoupper($rule->upgrade_plan);?></option>
<?php
foreach($data as $levels){
if( $rule->upgrade_plan != $levels->name){
?>
<option value="<?php echo $levels->name;?>"><?php echo strtoupper($levels->name);?></option>
<?php
}
}
?>
</select>

<?php
           echo'
           and fund him/her with <input type="number" name="bonus_amount'.$rule->id.'" placeholder="Bonus Amount" value="'.floatval($rule->upgrade_balance).'">
Plan if PV reaches <input type="number" name="required_pv'.$rule->id.'" placeholder="Required PV" value="'.floatval($rule->required_pv).'"></p>
<br/>
<button value="'.$rule->id.'" class="btn border border-secondary bg bg-danger text-white remove_rule" >Remove Rule ['.$rule->id.'] </button>
</td>
       </tr>
';
        }

        echo'
       </tbody>
       <tfoot>
<tr>
<th><button class="btn border border-secondary text-white bg bg-success rule-btn" >SAVE & ADD RULE"</button></th>
</tr>

       </tfoot>
    </table>

    
    <script>

    jQuery(".rule-btn").on("click",function(){
    
        var obj = {};
         obj["rule"] = "add";
        obj["level_action"] = "rule_action";
        obj["spraycode"] = "'.vp_getoption("spraycode").'";

        var toatl_input = jQuery(".pv_rules input, .pv_rules select, .pv_rules textarea").length;
var run_obj;

for(run_obj = 0; run_obj <= toatl_input; run_obj++){
var current_input = jQuery(".pv_rules input, .pv_rules select, .pv_rules textarea").eq(run_obj);


var obj_name = current_input.attr("name");
var obj_value = current_input.val();

if(typeof obj_name !== typeof undefined && obj_name !== false){
obj[obj_name] = obj_value;
}
	
	
}
    
         jQuery("#cover-spin").show();
    
         jQuery.ajax({
            url: "'.esc_url(plugins_url('vtupress/levels.php')).'",
            data: obj,
            dataType: "text",
            "cache": false,
            "async": true,
            error: function (jqXHR, exception) {
                jQuery("#cover-spin").hide();
                  var msg = "";
                  if (jqXHR.status === 0) {
                      msg = "No Connection.\n Verify Network.";
               swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
            
                  } else if (jqXHR.status == 404) {
                      msg = "Requested page not found. [404]";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (jqXHR.status == 500) {
                      msg = "Internal Server Error [500].";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "parsererror") {
                      msg = "Requested JSON parse failed.";
                         swal({
            title: "Error",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "timeout") {
                      msg = "Time out error.";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "abort") {
                      msg = "Ajax request aborted.";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else {
                      msg = "Uncaught Error.\n" + jqXHR.responseText;
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  }
              },
            success: function(data) {
              jQuery("#cover-spin").hide();
                  if(data == "100" ){
              
                    swal({
            title: "Success",
            text: "Rule Added",
            icon: "success",
            button: "Okay",
          }).then((value) => {
              location.reload();
          });
                }
                else{
                    
              jQuery("#cover-spin").hide();
               swal({
            title: "Error",
            text: data,
            icon: "error",
            button: "Okay",
          });
                }
            },
            type: "POST"
          });
    
    });

    jQuery(".remove_rule").on("click",function(){
    
        if(confirm("DO YOU WANNA DELETE THIS RULE?") == true){

        }
        else{
            return;
        }
                var obj = {};
                obj["rule_id"] = this.value;
                obj["level_action"] = "remove_rule";
        obj["spraycode"] = "'.vp_getoption("spraycode").'";

    
         jQuery("#cover-spin").show();
    
         jQuery.ajax({
            url: "'.esc_url(plugins_url('vtupress/levels.php')).'",
            data: obj,
            dataType: "text",
            "cache": false,
            "async": true,
            error: function (jqXHR, exception) {
                jQuery("#cover-spin").hide();
                  var msg = "";
                  if (jqXHR.status === 0) {
                      msg = "No Connection.\n Verify Network.";
               swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
            
                  } else if (jqXHR.status == 404) {
                      msg = "Requested page not found. [404]";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (jqXHR.status == 500) {
                      msg = "Internal Server Error [500].";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "parsererror") {
                      msg = "Requested JSON parse failed.";
                         swal({
            title: "Error",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "timeout") {
                      msg = "Time out error.";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else if (exception === "abort") {
                      msg = "Ajax request aborted.";
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  } else {
                      msg = "Uncaught Error.\n" + jqXHR.responseText;
                       swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Okay",
          });
                  }
              },
            success: function(data) {
              jQuery("#cover-spin").hide();
              if(data == "200" ){
              
                swal({
        title: "Success",
        text: "Rule Removed",
        icon: "success",
        button: "Okay",
      }).then((value) => {
          location.reload();
      });
            }
                else{
                    
              jQuery("#cover-spin").hide();
               swal({
            title: "Error",
            text: data,
            icon: "error",
            button: "Okay",
          });
                }
            },
            type: "POST"
          });
    
    });


          
          </script>
          
</div>
<br>




     <div class="mlm-refer">
     <table class="table table-striped table-hover table-bordered table-responsive">
             <thead>
                 <tr>
                     <th scope="col">Name</th>
                     <th scope="col">value</th>
                 </tr>
                 
               </thead>
           <tbody>
               <tr>
                   <td>Min. Withdrawal Limit</td>
                   <td><input type="number" class="form-control" name="minwith" value="'.vp_getoption("vp_min_withdrawal").'"></td>
               </tr>
              <tr>
                   <td>Min. Of Total Transaction Amount Required Before Withdrawal Can Be Allowed</td>
                   <td><input type="number" class="form-control" name="mintrans" value="'.vp_getoption("vp_trans_min").'"></td>
               </tr>
           </tbody>
        </table>
    </div>
	
	<input type="button" name="setmlm" value="Save" class="btn btn-primary savemlm">


<script>

jQuery(".savemlm").click(function(){
	jQuery("#cover-spin").show();
var obj = {};

var toatl_input = jQuery(".mlm_system input, .mlm_system select, .mlm_system textarea").length;
var run_obj;

for(run_obj = 0; run_obj <= toatl_input; run_obj++){
var current_input = jQuery(".mlm_system input, .mlm_system select, .mlm_system textarea").eq(run_obj);


var obj_name = current_input.attr("name");
var obj_value = current_input.val();

if(typeof obj_name !== typeof undefined && obj_name !== false){
obj[obj_name] = obj_value;
}
	
	
}

obj["spraycode"] = "'.vp_getoption("spraycode").'";


jQuery.ajax({
  url: "'.esc_url(plugins_url('vtupress/vend.php')).'",
  data: obj,
  dataType: "json",
  "cache": false,
  "async": true,
  error: function (jqXHR, exception) {
	  jQuery("#cover-spin").hide();
        var msg = "";
        if (jqXHR.status === 0) {
            msg = "No Connection.\n Verify Network.";
     swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
  
        } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
			 swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
			 swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
			   swal({
  title: "Error",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "timeout") {
            msg = "Time out error.";
			 swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "abort") {
            msg = "Ajax request aborted.";
			 swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
			 swal({
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        }
    },
  success: function(data) {
	jQuery("#cover-spin").hide();
        if(data.status == "100" ){
	
		  swal({
  title: "SAVED",
  text: "Update Completed",
  icon: "success",
  button: "Okay",
}).then((value) => {
	location.reload();
});
	  }
	  else{
		  
	jQuery("#cover-spin").hide();
	 swal({
  title: "Error",
  text: "Saving Wasn\"t Successful",
  icon: "error",
  button: "Okay",
});
	  }
  },
  type: "POST"
});

});

</script>
</div>
	';

}
else{
	
	echo "<h3>You are not allowed to use this addon 'cos you are not a premium user</h3>";
	
}

}



add_action("init", 'do_this');

function do_this(){
if(is_user_logged_in()){		
$current_user = get_current_user_id();
	
vp_adduser( $current_user, 'vp_who_ref' , 1); //who referred me
vp_adduser( $current_user, 'vp_tot_ref' , 0); //number of my direct referrs
vp_adduser( $current_user, 'vp_tot_in_ref' , 0); //number of my second level referrs
vp_adduser( $current_user, 'vp_tot_in_ref3' , 0); //number of my third level referrers referrs
vp_adduser( $current_user, 'vp_tot_ref_earn' , 0); // total earned from direct referers
vp_adduser( $current_user, 'vp_tot_in_ref_earn' , 0); // total earned from indirect referers
vp_adduser( $current_user, 'vp_tot_in_ref_earn3' , 0); // total earned from third level referers

vp_adduser( $current_user, 'vp_tot_trans' , 0);  // total transactions Attempted
vp_adduser( $current_user, 'vp_tot_suc_trans' , 0);  // total Successful transactions made
vp_adduser( $current_user, 'vp_tot_trans_amt' , 0); //total transactions amount consumed

vp_adduser( $current_user, 'vp_tot_dir_trans' , 0); //total transactions amount earned from direct
vp_adduser( $current_user, 'vp_tot_indir_trans' , 0); //total transactions amount earned from indirect
vp_adduser( $current_user, 'vp_tot_indir_trans3' , 0); //total transactions amount earned from third level

vp_adduser( $current_user, 'vp_tot_trans_bonus' , 0); //total transactions bonus earned
vp_adduser( $current_user, 'vp_tot_withdraws' , 0); // total withdrawals made

}
}


add_action("vp_mlm", "vp_mlm_function");

function vp_mlm_function(){
	
	if(is_user_logged_in()){
		
		$id = get_current_user_id();
		
		//Update number of transactions attempted
		$current_trans = vp_getuser( $id, 'vp_tot_trans' , true); //check current number of transactions attempted
		$update_trans = intval($current_trans) + 1;
		vp_updateuser( $id, 'vp_tot_trans' , $update_trans);
		
	}
	
}


$id = get_current_user_id();
add_action("vp_after", "vp_after_function");
add_action("vp_after_api", "vp_after_function_api");

function vp_after_function(){
	
	global $wpdb, $plan,$level,$amountv,$sec,$mlm_for,$realAmt;
#$level = data of current plam
#$plan = my current plan
$id = get_current_user_id();


$now_bal = vp_getuser($id,"vp_bal",true);

if($now_bal != $_COOKIE["last_bal"]){
  setcookie("last_bal", 0, time() + (30 * 24 * 60 * 60), "/");
}


$amount = apply_filters("alter_amount",$realAmt);



$memRuleTable = $wpdb->prefix."vp_membership_rule_stats";
$membership_rule = $wpdb->get_results("SELECT * FROM $memRuleTable WHERE user_id = '$id' ORDER BY ID DESC LIMIT 1");

if($membership_rule != NULL && !empty($membership_rule)){
  #Get Total transaction_number
$transNo =  intval($membership_rule[0]->transaction_number) + 1;
$transAmount =  floatval($membership_rule[0]->transaction_amount) + $amount;
$start_count = $membership_rule[0]->start_count;
$one_month_after = date("Y-m-d",strtotime($start_count."+1 month"));
$current_date = date("Y-m-d");
if($current_date < $one_month_after){

  $data = [
    'transaction_number' => $transNo,
    'transaction_amount' => $transAmount
  ];
$wpdb->update($memRuleTable,$data,['user_id'=>$id]);
}else{
  
  $data = [
    'user_id' => $id,
    'ref' => 0,
    'transaction_number' => 1,
    'transaction_amount' => $amount,
    'start_count' => $current_date
  ];
$wpdb->insert($memRuleTable,$data);

}
}



 // print_r($level);

	
	//$error = "\nMLM for";
	
//$error .= "\nMLM for  $mlm_for";
$usrs = $wpdb->prefix."users";





    $bal = vp_getuser($id, 'vp_bal', true);


$usrs_table1 = $wpdb->get_results("SELECT * FROM $usrs WHERE ID = $id ");
if(isset($usrs_table1[0]->vp_user_pv)){
if(empty($mlm_for)){

	$d_pv = floatval($usrs_table1[0]->vp_user_pv) + floatval($level[0]->airtime_pv);
	global $wpdb;
	$wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $id));

  }
  elseif($mlm_for == "_data"){
    $d_pv = floatval($usrs_table1[0]->vp_user_pv) + floatval($level[0]->data_pv);
    global $wpdb;
    $wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $id));
  }
  elseif($mlm_for == "_cable"){
    $d_pv = floatval($usrs_table1[0]->vp_user_pv) + floatval($level[0]->cable_pv);
    global $wpdb;
    $wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $id));
  }
  elseif($mlm_for == "_bill"){
    $d_pv = floatval($usrs_table1[0]->vp_user_pv) + floatval($level[0]->bill_pv);
    global $wpdb;
    $wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $id));
  }
	
}
	
	
	//update number of successful transactions
	$cur_suc_trans = vp_getuser($id, "vp_tot_suc_trans", true);
	$tot_suc_trans = intval($cur_suc_trans ) + 1;
	vp_updateuser($id, "vp_tot_suc_trans", $tot_suc_trans);
	
	
	//update total amount of successful transactions consumed
	$cur_suc_trans_amt = vp_getuser($id, "vp_tot_trans_amt",true);
	$tot_suc_trans_amt = floatval($cur_suc_trans_amt ) + floatval($amount);
	vp_updateuser($id, "vp_tot_trans_amt", $tot_suc_trans_amt);

	$tot = $bal - $amount;




if(strtolower($plan) != "custome" && vp_getoption("discount_method") != "direct"  && isset($level) && isset($level[0]->total_level)){
//add to my transactions bonus
$my_trans_bonus = vp_getuser($id, "vp_tot_trans_bonus", true);
$add_to_my_bonus = floatval($my_trans_bonus) + floatval($sec);
vp_updateuser($id, "vp_tot_trans_bonus", $add_to_my_bonus);
//$error .= "\nTrans Bonus = $add_to_my_bonus ";

}


//give my direct ref a bonus

//bonus cal bal after % from amount vended
if(strtolower($plan) != "custome"  && isset($level) && isset($level[0]->total_level)){
$my_dir_ref = vp_getuser($id, "vp_who_ref", true);//get direct refer id
//$error .= "\nWho ref is $my_dir_ref";

$total_level = $level[0]->total_level;

$the_user = $my_dir_ref;



for($lev = 1; $lev <= $total_level; $lev++){

$current_level = "level_".$lev;
//$error .= "\nCurrent Level is $current_level";
$current_level_pv = "level_".$lev;
//$error .= "\nCurrent Level PV is $current_level_pv";

if(empty($mlm_for)){
 //error_log("for airtime",0);
 //error_log("current level promo for airtime is ".$current_level,0);
$discount = floatval($level[0]->{$current_level});
$current_level_pv_bonus = floatval($level[0]->{$current_level_pv."_pv"});
}
elseif($mlm_for == "_data"){
$discount = floatval($level[0]->{$current_level."_data"});
$disas = $current_level."_data";
$current_level_pv_bonus = floatval($level[0]->{$current_level_pv."_data_pv"});
$leas = $current_level_pv."_data_pv";
//$error .= "\n Current Level = $current_level and Data PV is $current_level_pv_bonus as $leas and Discount % is $discount as $disas";
}
elseif($mlm_for == "_cable"){
$discount = floatval($level[0]->{$current_level."_cable"});
$current_level_pv_bonus = floatval($level[0]->{$current_level_pv."_cable_pv"}); 
}
elseif($mlm_for == "_bill"){
$discount = floatval($level[0]->{$current_level."_bill"});
$current_level_pv_bonus = floatval($level[0]->{$current_level_pv."_bill_pv"});
}
else{
    $discount = 0;
    $current_level_pv_bonus = 0;   
}

$give_away = (floatval($amount) * $discount) / 100;
//$error .= "\nAmount is $amount and Discount is $discount ";
//$error .= "\nGiveaway is $give_away ";

//error_log("Giveaway is (real of $amount) * $discount / 100 =  ".$give_away." for user with is $the_user",0);


if(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 1 && $the_user != "0" && $the_user != "false"){

$curr_dir_trans_bonus = vp_getuser($the_user, "vp_tot_dir_trans", true);
$add_to_direct_transb = floatval($curr_dir_trans_bonus) + floatval($give_away);
//$error .= "\nAdded is $add_to_direct_transb ";
vp_updateuser($the_user, "vp_tot_dir_trans", $add_to_direct_transb);

//error_log("Bonus is current of $curr_dir_trans_bonus + $give_away = $add_to_direct_transb for $the_user",0);


$usrs_table = $wpdb->get_results("SELECT * FROM $usrs WHERE ID = $the_user");
if(isset($usrs_table[0]->vp_user_pv)){
  //$error .= "\nIsset! ";
	$d_pv = floatval($usrs_table[0]->vp_user_pv) + $current_level_pv_bonus;
	global $wpdb;
	$wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $the_user));
}
else{}

}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 2 && $the_user != "0" && $the_user != "false"){
$curr_indir_trans_bonus = vp_getuser($the_user, "vp_tot_indir_trans", true);
$add_to_indirect_transb = floatval($curr_indir_trans_bonus) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans", $add_to_indirect_transb);

$usrs_table = $wpdb->get_results("SELECT * FROM $usrs WHERE ID = $the_user");
if(isset($usrs_table[0]->vp_user_pv)){
	$d_pv = floatval($usrs_table[0]->vp_user_pv) + $current_level_pv_bonus;
	global $wpdb;
	$wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $the_user));
}
else{}

}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 3  && $the_user != "0" && $the_user != "false"){
$curr_indir_trans_bonus3 = vp_getuser($the_user, "vp_tot_indir_trans3", true);
$add_to_indirect_transb3 = floatval($curr_indir_trans_bonus3) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans3", $add_to_indirect_transb3);


$usrs_table = $wpdb->get_results("SELECT * FROM $usrs WHERE ID = $the_user");
if(isset($usrs_table[0]->vp_user_pv)){
	$d_pv = floatval($usrs_table[0]->vp_user_pv) + $current_level_pv_bonus;
	global $wpdb;
	$wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $the_user));
}
else{}


}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev != 3 && $lev != 2 && $lev != 1  && $the_user != "0" && $the_user != "false"){
$other_in = vp_getuser($the_user, "vp_tot_indir_trans3", true);// this one for other levels that are above level 3 but part of persons ref
$add_to_other_in = floatval($other_in ) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans3", $add_to_other_in);

$usrs_table = $wpdb->get_results("SELECT * FROM $usrs WHERE ID = $the_user");
if(isset($usrs_table[0]->vp_user_pv)){
	$d_pv = floatval($usrs_table[0]->vp_user_pv) + $current_level_pv_bonus;
	global $wpdb;
	$wpdb->update($usrs, array('vp_user_pv' => $d_pv), array('ID'=> $the_user));
}
else{}


}
else{
	$lev = 90000000000;
}
//die($error);
	
$next_user = vp_getuser($the_user, "vp_who_ref", true);

$the_user = $next_user;
	
}


}
	
}





function vp_after_function_api(){
	
	global $id, $wpdb, $plan,$level,$amount,$sec;
	
	$id = $_REQUEST["id"];
    $bal = vp_getuser($id, 'vp_bal', true);

	
	
	//update number of successful transactions
	$cur_suc_trans = vp_getuser($id, "vp_tot_suc_trans", true);
	$tot_suc_trans = intval($cur_suc_trans ) + 1;
	vp_updateuser($id, "vp_tot_suc_trans", $tot_suc_trans);
	
	
	//update total amount of successful transactions consumed
	$cur_suc_trans_amt = vp_getuser($id, "vp_tot_trans_amt",true);
	$tot_suc_trans_amt = floatval($cur_suc_trans_amt ) + floatval($amount);
	vp_updateuser($id, "vp_tot_trans_amt", $tot_suc_trans_amt);

	$tot = $bal - $amount;


if(strtolower($plan) != "custome" && vp_getoption("discount_method") != "direct"  && isset($level) && isset($level[0]->total_level)){
//add to my transactions bonus
$my_trans_bonus = vp_getuser($id, "vp_tot_trans_bonus", true);
$add_to_my_bonus = floatval($my_trans_bonus) + floatval($sec);
vp_updateuser($id, "vp_tot_trans_bonus", $add_to_my_bonus);

}


//give my direct ref a bonus

//bonus cal bal after % from amount vended
if(strtolower($plan) != "custome"  && isset($level) && isset($level[0]->total_level)){
$my_dir_ref = vp_getuser($id, "vp_who_ref", true);//get direct refer id

$total_level = $level[0]->total_level;

$the_user = $my_dir_ref;


for($lev = 1; $lev <= $total_level; $lev++){

$current_level = "level_".$lev;
$discount = floatval($level[0]->{$current_level});

$give_away = (floatval($amount) * $discount) / 100;


if(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 1 && $the_user != "0" && $the_user != "false"){

$curr_dir_trans_bonus = vp_getuser($the_user, "vp_tot_dir_trans", true);
$add_to_direct_transb = floatval($curr_dir_trans_bonus) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_dir_trans", $add_to_direct_transb);
	
}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 2 && $the_user != "0" && $the_user != "false"){
$curr_indir_trans_bonus = vp_getuser($the_user, "vp_tot_indir_trans", true);
$add_to_indirect_transb = floatval($curr_indir_trans_bonus) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans", $add_to_indirect_transb);
}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev == 3  && $the_user != "0" && $the_user != "false"){
$curr_indir_trans_bonus3 = vp_getuser($the_user, "vp_tot_indir_trans3", true);
$add_to_indirect_transb3 = floatval($curr_indir_trans_bonus3) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans3", $add_to_indirect_transb3);
}
elseif(vp_getuser($the_user,"vr_plan",true) != "custome" && $lev != 3 && $lev != 2 && $lev != 1  && $the_user != "0" && $the_user != "false"){
$other_in = vp_getuser($the_user, "vp_tot_indir_trans3", true);// this one for other levels that are above level 3 but part of persons ref
$add_to_other_in = floatval($other_in ) + floatval($give_away);
vp_updateuser($the_user, "vp_tot_indir_trans3", $add_to_other_in);
}
else{
	$lev = 90000000000;
}
	
	
$next_user = vp_getuser($the_user, "vp_who_ref", true);

$the_user = $next_user;
	
}


}
	
}




}

