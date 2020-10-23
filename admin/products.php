<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('configDatabase2.php'); ?>
<?php  $results_per_page=5; 
//no of products shown on every page.
    $data = "SELECT * FROM `products`" ;
    $result=mysqli_query($conn, $data);
    $no_of_results = mysqli_num_rows($result); //returns the number of rows
                              ///////////////////////////////////////////////////////////////////////////////
    $no_of_pages=ceil($no_of_results/$results_per_page);
    if(!(isset($_GET['page']))) {
        $page=1;
    } else {
        $page=$_GET['page'];
    }

    $this_page_first_result=($page-1)*$results_per_page;
    ?>
<?php
if(isset($_POST['submit'])) {
    $name=isset($_POST['nameProduct'])?$_POST['nameProduct']:'';
    $price=isset($_POST['priceProduct'])?$_POST['priceProduct']:'';
    $id=isset($_POST['idProduct'])?$_POST['idProduct']:'';
    $category=isset($_POST['categoryProduct'])?$_POST['categoryProduct']:'';
    $shortDes=isset($_POST['short'])?$_POST['short']:'';
    $longDes=isset($_POST['long'])?$_POST['long']:'';
 
    $target="ProjectImages/".basename($_FILES['file']['name']);
    $image=$_FILES['file']['name'];

     $imageTemp=isset($_FILES['file']['tmp_name']);
     

        
     
     if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
         $primage=$_FILES['file']['name'];
    }
     else {
         echo "There was some problem uploading the image to the server";
     }


     $sql="INSERT INTO products(`name`, `price`, `product_id`, `image`,`category_id`, `short_desc`, `long_desc`) VALUES ('".$name."', '".$price."', '".$id."', '".$primage."', '".$category."', '".$shortDes."', '".$longDes."')" ;
         echo "Image Uploaded in database succesfully";


    if ($conn->query($sql) === true) {
        echo "New record created successfully"; 
        echo "<span class='input-notification success png_bg'>Successful message</span>";   
    }  
    else {    
            echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <noscript> <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    </div>
                </div>
            </noscript>
            
            <!-- Page Head -->
            <h2>Welcome John</h2>
            <p id="page-intro">What would you like to do?</p>
            
            <ul class="shortcut-buttons-set">
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/pencil_48.png" alt="icon" /><br />
                    Write an Article
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
                    Create a New Page
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/image_add_48.png" alt="icon" /><br />
                    Upload an Image
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/clock_48.png" alt="icon" /><br />
                    Add an Event
                </span></a></li>
                
                <li><a class="shortcut-button" href="#messages" rel="modal"><span>
                    <img src="resources/images/icons/comment_48.png" alt="icon" /><br />
                    Open Modal
                </span></a></li>
                
            </ul><!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Content box</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                <!-- MANAGE PRODUCTS WILL BE START FROM HERE -->
                <!-- WE WILL AGAIN ENTER PHP HERE TO SHOW THE PRODUCTS IN TABULAR FORM  -->
                
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div class="notification attention png_bg">
                            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                This is a Fontent Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                            </div>
                        </div>
                        <table>
                         <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>Name</th>
                                   <th>Price</th>
                                   <th>Product ID</th>
                                   <th>Image</th>
                                   <th>Category</th>
                                   <th>Short Description</th>
                                   <th>Long Description</th>
                                   <th>Action</th>
                                </tr>
                                
                            </thead>
                         
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <!-- <div class="bulk-actions align-left">
                                            <select name="dropdown">
                                                <option value="option1">Choose an action...</option>
                                                <option value="option2">Edit</option>
                                                <option value="option3">Delete</option>
                                            </select>
                                            <a class="button" href="#">Apply to selected</a>
                                        </div>
                                        -->
                                        <div class="pagination">
                                            
                                            <?php
                                             for($page=1;$page<=$no_of_pages;$page++) {
                                                echo "<a href='products.php?page=".$page." '>".$page."</a>";
                                            }
                                            ?>
                                            
                                        </div> 
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>


                            <?php
                            //MANAGE PRODUCT SECTION.
                            echo "<tbody id='tableBody' style='table-layout: fixed;'>";
                             

                            $sql3="SELECT * FROM `products` LIMIT $this_page_first_result, $results_per_page ";
                            $result3=mysqli_query($conn, $sql3);
                            // if (!$result3) {
                            //     printf("Error: %s\n", mysqli_error($conn));
                            //     exit();
                            // }
                            while ($row = mysqli_fetch_array($result3)) //to fetch a row as an associative array.
                            {
                                echo "<tr>";
                                        echo "<td><input type='checkbox' /></td>";
                                        echo "<td>".$row['name']."</td>";
                                        echo "<td>".$row['price']."</td>";
                                        echo "<td>".$row['product_id']."</td>";
                                        echo "<td>";
                                        echo "<img src='ProjectImages/".$row['image']."' height=100 width=100 >";
                                        echo "</td>";
                                        echo "<td>";
                                        $data2="SELECT `name` FROM `categories` WHERE `category_id`='".$row['category_id']."'";
                                        $check2=mysqli_query($conn, $data2);
                                        $no_of_rows2=mysqli_num_rows($check2);
                                        if($no_of_rows2>0) {
                                            $c=mysqli_fetch_assoc($check2);
                                            echo $c['name'];
                                        }//to get the category name in the manage product table
                                        "</td>";
                                        echo "<td>".$row['short_desc']."</td>";
                                        echo "<td>".substr($row['long_desc'], 0, 30).'...'. "</td>";
                                
                                     echo "<td>";// TO DELETE AND EDIT EACH ROW
                                            //<!-- Icons -->
                                            echo "<a href='edit.php?ID=".$row['product_id']."' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>";
                                            echo"<a href='delete.php?ID=".$row['product_id']."' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>"; 
                                     echo "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                            } 
                           
                            ?>
                         </table>
                        
                    </div> <!-- End #tab1 -->
                    
                    <div class="tab-content" id="tab2">
                    
                        <form action="#" method="POST" enctype="multipart/form-data">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Name of Product</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="nameProduct" required />  <!-- Classes for input-notification: success, error, information, attention -->
                                        <!-- SUCCESSFULL MSG -->
                                        <br /><small>Please enter the product name.</small>
                                </p>
                                
                                <p>
                                    <label>Price of Product</label>
                                    <input class="text-input medium-input datepicker" type="text" id="priceProduct" name="priceProduct" requierd /> <!--<span class="input-notification error png_bg">Error message</span>  -->
                                    <!-- ERROR MSG -->
                                </p>
                                
                                <p>
                                    <label>Product ID</label>
                                    <input class="text-input large-input" type="text" id="id" name="idProduct" required/>
                                </p>

                                <p>
                                    <label>Product Image</label>
                                    <input style="background-color:white;" class="text-input large-input" type="file"  id="imageID" name="file" required> 
                                </p>
                                
                                 <p>
                                    <label>Tags</label>
                                    <?php
                                    $query=mysqli_query($conn, "SELECT * FROM tags");
                                    $no_of_rows=mysqli_num_rows($query);
                                    if($no_of_rows>0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<input type="checkbox" name="checkbox1" value="1"/>';
                                            echo $row['name'];

                                        }
                                    }
                                    ?>
                                </p> 
                                
                                <p>
                                    <label>Categoty</label>              
                                    <select name="categoryProduct" class="small-input">
                                        <?php
                                        $query=mysqli_query($conn, "SELECT * FROM categories");
                                        $no_of_rows=mysqli_num_rows($query);
                                        if($no_of_rows>0) {
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value='.$row['category_id'].'>'.$row['name'].'</option>';
                                                echo $row['name'];
                                            }
                                    }
                                    ?>
                                       
                                    </select> 
                                </p>
                                <p>
                                    <label>Colors</label>
                                    <?php
                                    $query=mysqli_query($conn, "SELECT * FROM colors");
                                    $no_of_rows=mysqli_num_rows($query);
                                    if($no_of_rows>0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<input type="checkbox" name="checkbox1" value="1"/>';
                                            echo $row['color_name'];

                                        }
                                    }
                                    ?>
                                </p> 

                                <p>
                                    <label>Short description of Product</label>
                                    <textarea class="text-input textarea wysiwyg" id="textarea" name="short" ></textarea>
                                </p>
                                
                                <p>
                                    <label>Long description of Product</label>
                                    <textarea class="text-input textarea wysiwyg" id="textarea" name="long" cols="79" rows="15"></textarea>
                                </p>
                                
                                <p>
                                    <input class="button" name='submit' type="submit" value="Submit" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div> <!-- End #tab2 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->

            <!-- Start Notifications -->
            
            <!-- <div class="notification attention png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
                </div>
            </div>
            
            <div class="notification information png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification success png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification error png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div> -->
            
            <!-- End Notifications -->
            
            <?php   include('footer.php'); ?>