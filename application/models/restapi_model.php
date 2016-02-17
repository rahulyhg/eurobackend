<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{

public function getslider()
{
    $query=$this->db->query("SELECT `id`, `order`, `status`, `image` FROM `euro_homeslider` WHERE `status`=1 ORDER BY `order`")->result();
    return $query;
}
public function getExclusivePdt()
{
  $query=$this->db->query("SELECT `id`, `image1`, `image2` FROM `euro_exclusiveproduct` WHERE 1")->result();
  return $query;
}

public function getSubscribers($email){
        $query1=$this->db->query("SELECT * FROM `euro_subscribe` WHERE `email`='$email'");
    $num=$query1->num_rows();
    if($num>0)
    {
    $object = new stdClass();
    $object->value = false;
    $object->comment = 'already exists';
   return $object;
    }
    else{
    $this->db->query("INSERT INTO `euro_subscribe`(`email`) VALUE('$email')");
    $id=$this->db->insert_id();
    $object = new stdClass();
    $object->value = true;
    return $object;
          }
}

public function getAllProducts()
{
$query= $this->db->query("SELECT `id`,`name`,`subcategory` AS 'series',`image` FROM `euro_product`")->result();
return $query;
}
public function getHomePageImage()
{
$query= $this->db->query("SELECT `id`, `image1`, `image2`, `image3` FROM `euro_homepageimage`")->result();
return $query;
}
public function getGalleryImages()
{
$query= $this->db->query("SELECT  `euro_gallery`.`id`,  `euro_category`.`name` AS 'categoryName',`euro_category`.`image` AS 'categoryImg',  `euro_gallery`.`order`,  `euro_gallery`.`status`,  `euro_gallery`.`image`, `euro_gallery`.`pdf` FROM `euro_gallery` INNER JOIN `euro_category` ON `euro_gallery`.`category`=`euro_category`.`id`")->result();
return $query;
}

public function getAllSeries($category)
{
$query= $this->db->query("SELECT `name` FROM `euro_subcategory` WHERE `category`='$category' ORDER BY `order`")->result();
return $query;
}
public function series($id)
{
$query= $this->db->query("SELECT `euro_subcategory`.`name`,`euro_product`.`id` FROM `euro_subcategory` WHERE `category`='$category' ORDER BY `order`")->result();
return $query;
}

public function contactUs($name,$telephone,$email,$comment)
{
  $this->db->query("INSERT INTO `contact`(`name`,`telephone`,`email`,`comment`) VALUE('$name','$telephone','$email','$comment')");
  $id=$this->db->insert_id();
  if(!$id)
  {
    $object = new stdClass();
    $object->value = true;
    return $object;
  }
  else {
    $object = new stdClass();
    $object->value = false;
    return $object;
  }

}

}
?>
