<?php
/**
 * Template Name: Search Template [final]
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();

?>
<link href="./style.css" rel="stylesheet" type="text/css" />
<main id="site-content" role="main">

<?php 
$search_dog_name = $_REQUEST['search_dog_name'];
$search_puppy_name = $_REQUEST['search_puppy_name'];
$search_cat_name = $_REQUEST['search_cat_name'];
$search_dog_size = $_REQUEST['search_dog_size'];
$search_puppy_size = $_REQUEST['search_puppy_size'];
$search_cat_age = $_REQUEST['search_cat_age'];
$search_puppy_age = $_REQUEST['search_puppy_age'];
$search_cat_sex = $_REQUEST['search_cat_sex'];
$search_dog_sex = $_REQUEST['search_dog_sex'];
$search_puppy_sex = $_REQUEST['search_puppy_sex'];
$search_dog_age = $_REQUEST['search_dog_age'];
$include_puppy = false;

if($search_dog_age === 'Any Age'){
    $serialization='DESC';
    $search_dog_age = array(2010,date('Y'));
	$include_puppy = true;
}else if($search_dog_age === 'Under 1 Year'){
    $serialization='DESC';
    $search_dog_age = array(date('Ymd',strtotime('-12 months')),date('Ymd'));
	$include_puppy = true;
}else if($search_dog_age === '1 Year-4 Years'){
    $serialization='DESC';
    $search_dog_age = array(date('Y',strtotime('-4 year')),date('Y',strtotime('-1 year')));
}else if($search_dog_age === '4 Years-8 Years'){
    $serialization='DESC';
    $search_dog_age = array(date('Y',strtotime('-8 year')),date('Y',strtotime('-4 year')));
}else if($search_dog_age === '8 years+'){
    $serialization='DESC';
	$search_dog_age = array(2010,date('Y',strtotime('-8 year')));
}
if($search_puppy_age === 'Any Age'){
    $search_puppy_age = array(date('Y',strtotime('-3 year')),date('Y'));
    $serialization='DESC';
}else if($search_puppy_age === 'Youngest to Oldest'){
    $search_puppy_age = array(date('Y',strtotime('-3 year')),date('Ym',strtotime('-8 months')));
    $serialization='DESC';
}else if($search_puppy_age === 'Oldest to Youngest'){
    $search_puppy_age = array(date('Y',strtotime('-5 year')),date('Y'));
    $serialization='ASC';
}
if($search_cat_age === 'Any Age'){
    $search_cat_age = array(date('Y',strtotime('-5 year')),date('Y'));
    $serialization='DESC';
}else if($search_cat_age === 'Under 6 Months'){
    $search_cat_age = array(date('Ymd',strtotime("-6 months -1 week")),date('Ymd'));
    $serialization='DESC';
}else if($search_cat_age === '6 Months to 2 Years'){
    $search_cat_age = array(date('Ymd',strtotime('-2 year')),date('Ymd',strtotime('-6 months -1 days')));
    $serialization='DESC';
}else if($search_cat_age === '2 Years +'){
    $search_cat_age = array(date('Y',strtotime('-10 year')),date('Y',strtotime('-2 year')));
    $serialization='DESC';
}
if($search_dog_sex === 'Any Sex'){
    $search_dog_sex = array('Male','Female');
}else{
    $search_dog_sex = $_REQUEST['search_dog_sex'];
}
if($search_puppy_sex === 'Any Sex'){
    $search_puppy_sex = array('Male','Female');
}else{
    $search_puppy_sex = $_REQUEST['search_puppy_sex'];
}
if($search_cat_sex === 'Any Sex'){
    $search_cat_sex = array('Male','Female');
}else if($search_cat_sex != ""){
   $search_cat_sex = $_REQUEST['search_cat_sex']; 
}else{
   $search_cat_sex = $_REQUEST['search_cat_sex']; 
}
if($search_dog_size === 'Any Size'){
    $search_dog_size = array('random','');
    !empty($search_dog_age)? false: $serialization='DESC';
}else if($search_dog_size === 'Small'){
    $search_dog_size = array('filter','Small','Small-Medium');
    !empty($search_dog_age)? false: $serialization='ASC';
}else if($search_dog_size === 'Medium'){
    $search_dog_size = array('filter','Medium','Small-Medium','Medium-Large');
    !empty($search_dog_age)? false: $serialization='ASC';
}else if($search_dog_size === 'Large'){
    $search_dog_size = array('Filter','Large','Medium-Large', 'Very-Large');
    !empty($search_dog_age)? false: $serialization='ASC';
}else{
    $search_dog_size = $_REQUEST['search_dog_size'];
}
if($search_puppy_size === 'Any Size'){
    $search_dog_size = array('random','');
    !empty($search_puppy_age)? false: $serialization='ASC';
}else if($search_puppy_size === 'Small'){
    $search_puppy_size = array('filter','Small','Small-Medium','Very Small');
    !empty($search_puppy_age)? false: $serialization='ASC';
}else if($search_puppy_size === 'Medium'){
    $search_puppy_size = array('filter','Medium','Small-Medium','Medium-Large');
    !empty($search_puppy_age)? false: $serialization='ASC';
}else if($search_puppy_size === 'Large'){
    !empty($search_puppy_age)? false: $serialization='ASC';
    $search_puppy_size = array('filter','Medium-Large','Large','Very-Large');

}else{
    $search_puppy_size = $_REQUEST['search_puppy_size'];
}

?>
	
<div class="search_section container" style="margin:1rem auto">
        <div class="search_header">
            <div class="nav">
            <div class="search_menu">
                <span id="open" style="display:none;" class="search_brand">
					<ion-icon name="search-outline"></ion-icon>Search
				</span>
				<span id="close" style="display:flex;" class="search_brand">
					Close<ion-icon name="close-outline"></ion-icon>
				</span>
            </div>
            </div>
        </div>
        <div class="search_body" style="display:block;">
            <?php
             if($search_dog_name !="" || $search_dog_age !="" || $search_dog_size !="" || $search_dog_sex !=""){
                echo '<div class="search_form">
                <div class="input-section">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
               <select name="search_dog_age" id="age" >
                    <option value="'.$_REQUEST["'search_dog_age"].'" class="searched_dog_age" selected disabled>'.$_REQUEST['search_dog_age'].'</option>
                    <option value=""  >Age</option>
                    <option value="Any Age">Any Age</option>
                    <option value="Under 1 Year">Under 1 Year</option>
                    <option value="1 Year-4 Years">1 Year - 4 Years</option>
                    <option value="4 Years-8 Years">4 Years - 8 Years</option>
                    <option value="8 years+">8 Years +</option>
                </select>
                <select name="search_dog_sex" id="sex" >
                     <option value="'.$_REQUEST["'search_dog_sex"].'" class="searched_dog_sex" selected disabled>'.$_REQUEST['search_dog_sex'].'</option>
                    <option value=""  >Sex</option>
                    <option value="Any Sex">Any Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select name="search_dog_size" id="size" >
                    <option value="'.$_REQUEST["'search_dog_size"].'" class="searched_dog_size" selected disabled>'.$_REQUEST['search_dog_size'].'</option>
                    <option value=""  >Size</option>
                    <option value="Any Size">Any Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>
            
                <div class="search-btn">
                  <div class="search_button">
                    <a href="https://oceanacresanimalsanctuary.org/oceanacresanimal/view/adopt-a-dog/" style="background: #ffffff00 !important;
                     padding: 0;
                     color: #138091;
                     font-weight: 500;
                     margin-top: 12px;
                     border:none;
                     outline:none;
                     text-transform:uppercase;
                     text-decoration:underline;
                  "type="reset" class="reset-btn" value="Reset">Reset</a>
                  </div>
                  <div class="search_button">
                    <input type="submit" class="search-btn-adp"  onClick="return empty()"  value="Search">
                    </div>
                </div>
             </form>
             <div class="name-search">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
                 <input type="text" name="search_dog_name" id="myInput"  class="search-name" placeholder="Search by Dogs Name" required>
                 <input type="submit" value="" ><i class="fas fa-search"></i>
             </form>
            </div>
			 </div>';
            }else if($search_dog_name != "" || $search_dog_age !="" || $search_dog_size!="" || $search_dog_sex !=""){
                echo '<div class="search_form">
                <div class="input-section">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
                <select name="search_dog_age" id="age" >
                    <option value="'.$_REQUEST["'search_dog_age"].'" class="searched_dog_age" selected disabled>'.$_REQUEST['search_dog_age'].'</option>
                    <option value=""  >Age</option>
                    <option value="Any Age">Any Age</option>
                    <option value="Under 1 Year">Under 1 Year</option>
                    <option value="1 Year-4 Years">1 Year - 4 Years</option>
                    <option value="4 Years-8 Years">4 Years - 8 Years</option>
                    <option value="8 years+">8 Years +</option>
                </select>
                <select name="search_dog_sex" id="sex" >
                     <option value="'.$_REQUEST["'search_dog_sex"].'" class="searched_dog_sex" selected disabled>'.$_REQUEST['search_dog_sex'].'</option>
                    <option value=""  >Sex</option>
                    <option value="Any Sex">Any Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select name="search_dog_size" id="size" >
                    <option value="'.$_REQUEST["'search_dog_size"].'" class="searched_dog_size" selected disabled>'.$_REQUEST['search_dog_size'].'</option>
                    <option value=""  >Size</option>
                    <option value="Any Size">Any Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>
            
                <div class="search-btn">
                  <div class="search_button">
                  <a href="https://oceanacresanimalsanctuary.org/oceanacresanimal/view/adopt-a-dog/" style="background: #ffffff00 !important;
                     padding: 0;
                     color: #138091;
                     font-weight: 500;
                     margin-top: 12px;
                     border:none;
                     outline:none;
                     text-transform:uppercase;
                     text-decoration:underline;
                  "type="reset" class="reset-btn" value="Reset">Reset</button>
                  </div>
                  <div class="search_button">
                    <input type="submit" class="search-btn-adp"  onClick="return empty()" value="Search">
                    </div>
                </div>
             </form>
             <div class="name-search">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
                 <input type="text" name="search_dog_name" id="myInput" class="search-name" placeholder="Search by Dogs Name" required>
                 <input type="submit" value="" ><i class="fas fa-search"></i>
             </form>
            </div>
			 </div>';
            }else if($search_puppy_name != "" || $search_puppy_age != "" || $search_puppy_sex != "" || $search_puppy_size != ""){
                echo '<div class="search_form">
                <div class="input-section">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-puppy" method="POST">
                 <select name="search_puppy_age" id="age" >
                <option value="'.$_REQUEST["'search_puppy_age"].'" class="searched_puppy_age" selected disabled>'.$_REQUEST['search_puppy_age'].'</option>
                    <option value=""  >Age</option>
                    <option value="Any Age">Any Age</option>
                    <option value="Youngest to Oldest">Youngest to Oldest</option>
                    <option value="Oldest to Youngest">Oldest to Youngest</option>
                </select>
                <select name="search_puppy_sex" id="sex" >
                <option value="'.$_REQUEST["'search_puppy_sex"].'" class="searched_puppy_sex" selected disabled>'.$_REQUEST['search_puppy_sex'].'</option>
                    <option value=""  >Sex</option>
                    <option value="Any Sex">Any Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
				<select name="search_puppy_size" id="size" >
				<option value="'.$_REQUEST["'search_puppy_size"].'" class="searched_puppy_size" selected disabled>'.$_REQUEST['search_puppy_size'].'</option>
                    <option value=""  >Adult Size</option>
                    <option value="Any Size">Any Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>
                <div class="search-btn">
                   <div class="search_button">
                    <a href="https://oceanacresanimalsanctuary.org/oceanacresanimal/view/adopt-a-puppy/" style="background: #ffffff00 !important;
                     padding: 0;
                     color: #138091;
                     font-weight: 500;
                     margin-top: 12px;
                     border:none;
                     outline:none;
                     text-transform:uppercase;
                     text-decoration:underline;
                  "type="reset" class="reset-btn"  value="Reset">Reset</a>
                   </div>
                   <div class="search_button">
                    <input type="submit" class="search-btn-adp"  onClick="return empty()" value="Search">
                    </div>
                </div>
             </form>
             <div class="name-search">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-puppy" method="POST">
                 <input type="text"  name="search_puppy_name" id="myInput" class="search-name" placeholder="Search by Puppies Name" required>
                 <input type="submit" value=""><i class="fas fa-search"></i>
             </form>
            </div>
			 </div>';
            }else if($search_cat_name != "" || $search_cat_age != "" || $search_cat_sex != "" ){
                echo '<div class="search_form">
                <div class="input-section">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-cat" method="POST">
                 <select name="search_cat_age"  id="age" >
                 <option value="'.$_REQUEST["'search_cat_age"].'" class="searched_cat_age" selected disabled >'.$_REQUEST['search_cat_age'].'</option>
                    <option value="">Age</option>
                    <option value="Any Age">Any Age</option>
                    <option value="Under 6 Months">Under 6 Months</option>
                    <option value="6 Months to 2 Years">6 Months to 2 Years</option>
                    <option value="2 Years +">2 Years +</option>
                </select>
                
                <select name="search_cat_sex"  id="sex" >
                <option value="'.$_REQUEST["'search_cat_sex"].'" class="searched_cat_sex" selected disabled >'.$_REQUEST['search_cat_sex'].'</option>
                    <option value="">Sex</option>
                    <option value="Any Sex">Any Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select name="" style="visibility:hidden;" id="size" >
            
                    <option value="">Size</option>
                </select>
                
            </div>
                <div class="search-btn">
                   <div class="search_button">
                    <a href="https://oceanacresanimalsanctuary.org/oceanacresanimal/view/adopt-a-cat/" style="background: #ffffff00 !important;
                     padding: 0;
                     color: #138091;
                     font-weight: 500;
                     margin-top: 12px;
                     border:none;
                     outline:none;
                     text-transform:uppercase;
                     text-decoration:underline;
                  "type="reset" class="reset-btn" value="Reset">Reset</a>
                   </div>
                   <div class="search_button">
                    <input type="submit" class="search-btn-adp"  onClick="return empty()" value="Search">
                    </div>
                </div>
             </form>
             <div class="name-search">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-cat" method="POST">
                 <input type="text" name="search_cat_name" id="myInput"  class="search-name" placeholder="Search by Cat/Kitten\'s Name" required>
                 <input type="submit" value="" ><i class="fas fa-search"></i>
             </form>
			 </div>
			 </div>';
            } else {
				 echo '<div class="search_form">
                <div class="input-section">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
                 <select name="search_dog_age" id="age" >
                    <option value="'.$_REQUEST["'search_dog_age"].'" class="searched_dog_age" selected disabled>'.$_REQUEST['search_dog_age'].'</option>
                    <option value=""  >Age</option>
                    <option value="Any Age">Any Age</option>
                    <option value="Under 1 Year">Under 1 Years</option>
                    <option value="4 Years-8 Years">4 Years - 8 Years</option>
                    <option value="8 years+">8 Years +</option>
                </select>
                <select name="search_dog_sex" id="sex" >
                     <option value="'.$_REQUEST["'search_dog_sex"].'" class="searched_dog_sex" selected disabled>'.$_REQUEST['search_dog_sex'].'</option>
                    <option value="" >Sex</option>
                    <option value="Any Sex">Any Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select name="search_dog_size" id="size" >
                    <option value="'.$_REQUEST["'search_dog_size"].'" class="searched_dog_size" selected disabled>'.$_REQUEST['search_dog_size'].'</option>
                    <option value=""  >Size</option>
                    <option value="Any Size">Any Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>
            
                <div class="search-btn">
                  <div class="search_button">
                    <a href="https://oceanacresanimalsanctuary.org/oceanacresanimal/view/adopt-a-dog/" style="background: #ffffff00 !important;
                     padding: 0;
                     color: #138091;
                     font-weight: 500;
                     margin-top: 12px;
                     border:none;
                     outline:none;
                     text-transform:uppercase;
                     text-decoration:underline;
                  "type="reset" class="reset-btn" value="Reset">Reset</a>
                  </div>
                  <div class="search_button">
                    <input type="submit" class="search-btn-adp" onClick="return empty()" value="Search" >
                    </div>
                </div>
             </form>
             <div class="name-search">
             <form action="https://oceanacresanimalsanctuary.org/oceanacresanimal/?page_id=8182&pet_group=adopt-a-dog" method="POST">
                 <input type="text" name="search_dog_name" id="myInput" class="search-name" placeholder="Search by Dogs Name" required>
                 <input type="submit" value=""><i class="fas fa-search"></i>
             </form>
            </div>
			 </div>';
			 }
            ?>
             <div class="check_input" style="display:none; margin-top:30px">
       	<h2 class="text-danger text-center" style="margin-top:30px;">Please Choose Your Search Options</h2>
    </div>
        </div>
    </div>
<div class="bootstrap-wrapper">
<div class="container">
    
<div class="">
<?php
$search_puppy_sex_val = '';
$search_dog_sex_val = '';
$search_puppy_sex_val = '';
if($search_dog_name != ""){
 	echo do_shortcode('[ajax_load_more  container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog" pet_type="Dog" taxonomy_operator="IN" 
	search='.$search_dog_name.' orderby="relevance" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_puppy_name != ""){
	 echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" pet_type="Puppy" taxonomy_operator="IN" 
	 search='.$search_puppy_name.' 
	 orderby="relevance"  
	 custom_args="meta_key:date_of_birth,orderby:meta_value" 
	 scroll="false" transition_container="false" placeholder="true"]');
}else if($search_cat_name != ""){
	 echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-cat" pet_type="Cat" taxonomy_operator="IN" 
	 search='.$search_cat_name.' 
	 orderby="relevance"  
	 custom_args="meta_key:date_of_birth,orderby:meta_value" 
	 scroll="false" transition_container="false" placeholder="true"]');
}
// else if($search_dog_sex !="" && $search_dog_size !="" && $search_dog_age !=""){
// 	$include_puppy == true ? $pet_type = 'Dog,Puppy': $pet_type = 'Dog';
// 	is_array($search_dog_sex) ? $search_dog_sex_val = implode(',',$search_dog_sex) : $search_dog_sex_val = $search_dog_sex;
// 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog,adopt-a-puppy" taxonomy_operator="IN" 
// 	meta_key="size:size" 
// meta_value="'.$search_dog_size[0].':'.$search_dog_size[1].'" 
// 	meta_compare="!=:LIKE" 
// 	meta_type="CHAR:CHAR" 
// 	meta_relation="AND" 
// 	orderby="meta_value_num" order="'.$serializatin.'" 
// 	custom_args="orderby:size scroll="false" transition_container="false" placeholder="true"]');	
// }
// else if($search_puppy_size !="" && $search_dog_size =="" && $search_puppy_age ==""){
//  	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" pet_type="Puppy" taxonomy_operator="IN" 
// 	meta_key="size:size" 
// 	meta_value="'.$search_puppy_size[0].':'.$search_puppy_size[1].'" 
// 	meta_compare="!=:LIKE" 
// 	meta_relation="AND" 
// 	meta_type="CHAR:CHAR" orderby="meta_num_value" order="'.$serialization.'" 
// 	custom_args="orderby:size" scroll="false" transition_container="false" placeholder="true"]');
// }
else if($search_dog_sex !="" && $search_dog_size !="" && $search_dog_age !=""){
	$include_puppy == true ? $pet_type = 'Dog,Puppy': $pet_type = 'Dog';
	is_array($search_dog_sex) ? $search_dog_sex_val = implode(',',$search_dog_sex) : $search_dog_sex_val = $search_dog_sex;
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog,adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:sex:size:pet_type" 
meta_value="'.$search_dog_age[1].':'.$search_dog_age[0].':'.$search_dog_sex_val.':'.$search_dog_size[1].':'.$pet_type.'" 
	meta_compare="<=:>=:IN:LIKE:IN" 
	meta_type="DATE:DATE:CHAR:CHAR:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serializatin.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');	
}
else if($search_puppy_sex !="" && $search_puppy_size !="" && $search_puppy_age !=""){
	is_array($search_puppy_sex) ? $search_puppy_sex_val = implode(',',$search_puppy_sex) : $search_puppy_sex_val = $search_puppy_sex;
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" pet_type="Puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:sex:size" 
	meta_value="'.$search_puppy_age[1].':'.$search_puppy_age[0].':'.$search_puppy_sex_val.':'.$search_puppy_size[1].'" 
	meta_compare="lessthan:>=:IN:LIKE" 
	meta_type="DATE:DATE:CHAR:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');		
}
else if($search_cat_sex !="" && $search_cat_age !=""){
	is_array($search_cat_sex) ? $search_cat_sex_val = implode(',',$search_cat_sex) : $search_cat_sex_val = $search_cat_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-cat" pet_type="Cat" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:sex" 
	meta_value="'.$search_cat_age[1].':'.$search_cat_age[0].':'.$search_cat_sex_val.'" 
	meta_compare="<=:>=:IN"
	meta_type="DATE:DATE:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');		
}else if($search_dog_sex !="" && $search_dog_size !="" && $search_dog_age ==""){
	is_array($search_dog_sex) ? $search_dog_sex_val = implode(',',$search_dog_sex) : $search_dog_sex_val = $search_dog_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog" pet_type="Dog" taxonomy_operator="IN" 
	meta_key="size:size:sex" 
	meta_value="'.$search_dog_size[0].':'.$search_dog_size[1].':'.$search_dog_sex_val.'" 
	meta_compare="!=:LIKE:IN" 
	meta_type="CHAR:CHAR:CHAR" 
	meta_relation = "AND"
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="orderby:size" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_dog_sex !="" && $search_dog_size =="" && $search_dog_age !=""){
	$include_puppy == true ? $pet_type = 'Dog,Puppy': $pet_type = 'Dog';
	is_array($search_dog_sex) ? $search_dog_sex_val = implode(',',$search_dog_sex) : $search_dog_sex_val = $search_dog_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog,adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:sex:pet_type" 
	meta_value="'.$search_dog_age[1].':'.$search_dog_age[0].':'.$search_dog_sex_val.':'.$pet_type.'" 
	meta_compare="lessthan:>=:IN:IN" 
	meta_type="DATE:DATE:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" scroll="false" transition_container="false" placeholder="true"]');	
}else if($search_puppy_sex !="" && $search_puppy_size !="" && $search_puppy_age ==""){
	is_array($search_puppy_sex) ? $search_puppy_sex_val = implode(',',$search_puppy_sex) : $search_puppy_sex_val = $search_puppy_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" pet_type="Puppy" taxonomy_operator="IN" 
	meta_key="size:size:sex" 
	meta_value="'.$search_puppy_size[0].':'.$search_puppy_size[1].':'.$search_puppy_sex_val.'" 
	meta_compare="!=:LIKE:IN" 
	meta_type="CHAR:CHAR:CHAR" 
	meta_relation = "AND"
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="orderby:size" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_puppy_sex !="" && $search_puppy_size =="" && $search_puppy_age !=""){
	is_array($search_puppy_sex) ? $search_puppy_sex_val = implode(',',$search_puppy_sex) : $search_puppy_sex_val = $search_puppy_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:sex" 
	meta_value="'.$search_puppy_age[1].':'.$search_puppy_age[0].':'.$search_puppy_sex_val.'" 
	meta_compare="<=:>=:IN" 
	meta_type="DATE:DATE:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_cat_sex !="" && $search_dog_sex =="" && $search_puppy_sex ==""){
	is_array($search_cat_sex) ? $search_cat_sex_val = implode(',',$search_cat_sex) : $search_cat_sex_val = $search_cat_sex;
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-cat" taxonomy_operator="IN"
	meta_key="sex" meta_value="'.$search_cat_sex_val.'" 
	meta_compare="IN" 
	meta_type="CHAR" 
	orderby="meta_value_num" order="DESC" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_dog_sex !="" && $search_cat_sex =="" && $search_puppy_sex ==""){
	is_array($search_dog_sex) ? $search_dog_sex_val = implode(',',$search_dog_sex) : $search_dog_sex_val = $search_dog_sex;
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog" pet_type="Dog" taxonomy_operator="IN" 
	meta_key="sex" meta_value="'.$search_dog_sex_val.'" 
	meta_compare="IN" 
	meta_type="CHAR" 
	orderby="meta_value_num" order="ASC" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_puppy_sex !="" && $search_dog_sex =="" && $search_cat_sex ==""){
	is_array($search_puppy_sex) ? $search_puppy_sex_val = implode(',',$search_puppy_sex) : $search_puppy_sex_val = $search_puppy_sex;
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="sex" meta_value="'.$search_puppy_sex_val.'" 
	meta_compare="IN" 
	meta_type="CHAR" 
	orderby="meta_value_num" order="ASC" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_dog_size !="" && $search_dog_sex =="" && $search_dog_age !=""){
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:size:size" 
	meta_value="'.$search_dog_age[1].':'.$search_dog_age[0].':'.$search_dog_size[0].':'.$search_dog_size[1].'" 
	meta_compare="<=:>=:!=:IN" 
	meta_type="DATE:DATE:CHAR:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_dog_size !="" && $search_puppy_size =="" && $search_dog_age ==""){
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog" pet_type="Dog" taxonomy_operator="IN" 
	meta_key="size:size" meta_value="'.$search_dog_size[0].':'.$search_dog_size[1].'" 
	meta_compare="!=:LIKE" 
	meta_type="CHAR:CHAR" 
	order="'.$serialization.'" 
	meta_relation="AND"
	custom_args="orderby:size" 
	scroll="false" transition_container="false" placeholder="true"]');	
}else if($search_puppy_size !="" && $search_dog_size =="" && $search_puppy_age !=""){
	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth:size:size" 
	meta_value="'.$search_puppy_age[1].':'.$search_puppy_age[0].':'.$search_puppy_size[0].':'.$search_puppy_size[1].'" 
	meta_compare="<=:>=:!=:IN" 
	meta_type="DATE:DATE:CHAR:CHAR" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');
}else if($search_puppy_size !="" && $search_dog_size =="" && $search_puppy_age ==""){
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" pet_type="Puppy" taxonomy_operator="IN" 
	meta_key="size:size" 
	meta_value="'.$search_puppy_size[0].':'.$search_puppy_size[1].'" 
	meta_compare="!=:LIKE" 
	meta_relation="AND" 
	meta_type="CHAR:CHAR" orderby="meta_num_value" order="'.$serialization.'" 
	custom_args="orderby:size" scroll="false" transition_container="false" placeholder="true"]');
}else if($search_dog_age !="" && $search_cat_age =="" && $search_puppy_age =="" ){
	$include_puppy == false ? $pet_type = 'Dog': $pet_type = 'Dog,Puppy';
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-dog, adopt-a-puppy"
	meta_key="date_of_birth:date_of_birth:pet_type" 
	meta_value="'.$search_dog_age[1].':'.$search_dog_age[0].':'.$pet_type.'" 
	meta_compare="<=:>=:IN" 
	meta_type="DATE:DATE" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');		
}else if($search_dog_age =="" && $search_puppy_age !="" && $search_cat_age ==""){
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" pet_type="Puppy" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-puppy" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth" 
	meta_value="'.$search_puppy_age[1].':'.$search_puppy_age[0].'" 
	meta_compare="<=:>=" 
	meta_type="DATE:DATE" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');	
}else if($search_dog_age =="" && $search_puppy_age =="" && $search_cat_age !=""){
 	echo do_shortcode('[ajax_load_more container_type="div" post_type="pet" pet_type="Cat" posts_per_page="24" taxonomy="pet_group" taxonomy_terms="adopt-a-cat" taxonomy_operator="IN" 
	meta_key="date_of_birth:date_of_birth" 
	meta_value="'.$search_cat_age[1].':'.$search_cat_age[0].'" 
	meta_compare="<=:>" 
	meta_type="DATE:DATE" 
	meta_relation="AND" 
	orderby="meta_value_num" order="'.$serialization.'" 
	custom_args="meta_key:date_of_birth,orderby:meta_value" 
	scroll="false" transition_container="false" placeholder="true"]');	
}

if (!$_REQUEST['search_dog_age']){
        
        echo '<script type="text/javascript">
        
        $(".searched_dog_age").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_dog_size']){
        
        echo '<script type="text/javascript">
        
        $(".searched_dog_size").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_dog_sex']){
        
        echo '<script type="text/javascript">
        
        $(".searched_dog_sex").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_puppy_age']){
        
        echo '<script type="text/javascript">
        
        $(".searched_puppy_age").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_puppy_size']){
        
        echo '<script type="text/javascript">
        
        $(".searched_puppy_size").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_puppy_sex']){
        
        echo '<script type="text/javascript">
        
        $(".searched_puppy_sex").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_cat_sex']){
        
        echo '<script type="text/javascript">
        
        $(".searched_cat_sex").removeAttr("selected")
        
        </script>';
    }
    if (!$_REQUEST['search_cat_age']){
        
        echo '<script type="text/javascript">
        
        $(".searched_cat_age").removeAttr("selected")
        
        </script>';
    }

if($_REQUEST['search_cat_sex'] || $_REQUEST['search_dog_sex'] ||$_REQUEST['search_puppy_sex']){
    echo '<script>
    $("#sex").css({"background-color": "#797a7e ", "color": "white"});
    </script>';
}

if($_REQUEST['search_cat_age'] || $_REQUEST['search_dog_age'] ||$_REQUEST['search_puppy_age']){
        echo '<script>
    $("#age").css({"background-color": "#797a7e ", "color": "white"});
    </script>';
}
if(  $_REQUEST['search_dog_size'] ||$_REQUEST['search_puppy_size']){
        echo '<script>
    $("#size").css({"background-color": "#797a7e ", "color": "white"});
    </script>';
}
?>

</div>
</div>
</div> 



</main>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type="text/javascript">
	window.almEmpty = function(alm){
		window.location.replace("https://oceanacresanimalsanctuary.org/oceanacresanimal/?pet_group='<?=$_GET['pet_group']?>'&&noresult=1");
	};
    let open = document.querySelector("#open");
	let close = document.querySelector("#close");
	let search_body = document.querySelector(".search_body");
	
	open.addEventListener("click", openSeach);
	close.addEventListener("click", closeSeach);
	function openSeach(){
		close.style.display = "flex";
		open.style.display = "none";
		search_body.style.display = "flex";
	}
	function closeSeach(){
		open.style.display = "flex";
		close.style.display = "none";
		search_body.style.display = "none";
	}
	
	function empty() {
		var sex="";
		var age="";
		var size="";
		sex = document.getElementById("sex").value;
		age = document.getElementById("age").value;
		size = document.getElementById("size").value;
		if ((size== "")&&(sex=="")&&(age=="")) {
		     var empty_iput = document.querySelector(".check_input"); 
         document.querySelector(".check_input").style.display="block";
         document.querySelector(".check_input").scrollIntoView(false);
			return false;
		}
	}
	
	
$(document).ready(function(){
    $("#myInput").on("input", function(){
    
       
     $("#myInput").text($(this).val()).css("text-transform", "Capitalize");

    });
    
    $('select').on('change', function() {
    if ($(this).val()) {
    return $(this).css({"background-color": "#797a7e ", "color": "white"});
      } 
    else {
      return $(this).css({"background-color": "white", "color": "#52514f"});
      }
});

      $(".reset-btn").click(function(){

             $('select').css({"background-color": "white", "color": "#52514f"});
             $(".searched_dog_age").removeAttr("selected")
             $(".searched_dog_sex").removeAttr("selected")
             $(".searched_dog_size").removeAttr("selected")
             $(".searched_puppy_age").removeAttr("selected")
             $(".searched_puppy_sex").removeAttr("selected")
             $(".searched_puppy_size").removeAttr("selected")
             $(".searched_cat_age").removeAttr("selected")
             $(".searched_cat_sex").removeAttr("selected")

       });
});
	
  
</script>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
